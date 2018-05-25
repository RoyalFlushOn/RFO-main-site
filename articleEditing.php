<?php session_start();
	include 'appClass/Autoloader.php';

	$user = $headline = $tagline = $page = $finalImgPth = $artFilePath = $imagePath = $finalArtFile = '';

	$hdLnErr = $artFlErr = $thmbErr = $tagErr = $upldFrmErr = '';

	$fileNms = $tmpLoc = $errors = array();

	$formStat = false;

	if(isset($_SESSION['user'])){

		$temp = $_SESSION['user'];
		$userDetails = json_decode($temp);

		if($userDetails->level != 99){

			$message = new Message('You must have the right user level to access page, if you wish to please contact admin@royalflush.online.', 'info');
			$message->addMessageToSession();

			//header('location:' . htmlspecialchars($_SERVER['HTTP_HOST']));
			//dev only
			// header('location:' . htmlspecialchars($_SERVER['HTTP_HOST']) . '/RFO-main-site/index.php');
			// $link =  htmlspecialchars($_SERVER['HTTP_HOST']) . '/RFO-main-site/index.php';
			// header('location:' . $link);
			header('location: index.php');
	
		}

	} else {

		$message = new Message('Sorry you must logged in to use this page.', 'warning');
		$message->addMessageToSession();

		//header('location:' . htmlspecialchars($_SERVER['HTTP_HOST']));
		//dev only
		// header('location:' . htmlspecialchars($_SERVER['HTTP_HOST']) . '/RFO-main-site/index.php');
		$link =  htmlspecialchars($_SERVER['HTTP_HOST']) . '/RFO-main-site/index.php';
		header('location:http://' . $link);
	
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){

		if(!empty($_POST['form'])){

			if($_POST['form'] == 'upload'){
				uploadForm();
			} else {
				createForm();
			}
		}

	} else {
		echo '<script> var hdLnErr = "";
					var artFlErr = "";
					var thmbErr = "";
					var tagErr = "";
					var upldErr= "";
				</script>';
	}
		
	function uploadForm(){

		$baseDir = __DIR__;
		$formStat = false;
		
		$articleID = new Article();
		$artId = $articleID->createID();

		$user = $userDetails->user;

		if(!empty($_POST['headline'])){
			$headline = htmlspecialchars($_POST['headline']);

			$formStat = true;

		} else {
			$hdLnErr = 'Please enter the headline of your article please.';

			$formStat = false;
		}

		if(!empty($_FILES['file'])){

			$nameArr = $_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$errArr = $_FILES['file']['error'];
			$size = $_FILES['file']['size'];


			if($size[0] > 0){

				$temp = basename($nameArr[0]);
				$ext = pathinfo($temp, PATHINFO_EXTENSION);

				if($ext == "html"){
					$extStat = false;
				} else if ($ext == 'txt'){
					$extStat = false;
				} else {
					$extStat = true;
				}

				if($extStat){
					$artFlErr = 'Correct file format needed either .txt or .html please.';

					$formStat = false;
				} else {
				
					$artFilePath = $baseDir . '/article-files/unvalidated/' . $user;
					
					if(!is_dir($artFilePath)){
						mkdir($artFilePath);
					}

					$artFilePath = $artFilePath . '/' . $artId;
					
					if(!is_dir($artFilePath)){
						mkdir($artFilePath);
					}

					$finalArtFile = $artFilePath . '/' . $nameArr[0];

					if(!file_exists($finalArtFile)){

						if($formStat){
							if(move_uploaded_file($tmp_name[0], $finalArtFile)){
								$formStat  = true;
							} else {
								$formStat = false;

								$artFlErr = 'Error with file upload please try again. If persists please contact admin.';
								
							}
						}

						
					} else {
						$formStat = false;

						$artFlErr = 'Error file aready exists, please upload differet file. If you' .
										' think this is wrong please contact admin for support';
					}
				}

			} else {
				$artFlErr = 'File not preset, please make sure one is selected';
			}

			

			

			if(getimagesize($tmp_name[1])){

				$imagePath = $baseDir. '/images/articles/' . $user;

				if(!is_dir($imagePath)){
					mkdir($imagePath);
				}

				$imagePath = $imagePath . '/' . $artId;

				if(!is_dir($imagePath)){
					mkdir($imagePath);
				}

				$finalImgPth = $imagePath . '/' . $nameArr[1];
		

				if($formStat){
					if(move_uploaded_file($tmp_name[1], $finalImgPth)){
						
						$formStat  = true;
					} else {
						$formStat = false;

						$thmbErr = 'Error with file uploading please try again. If persists please contact admin.';

					
					}
				}
			} else {
				$formStat = false;

				$thmbErr ='Error with image, please ensure you have selected a image file.';
				
			}

			
		} else {
			$formStat = false;

			$thmbErr = $artFlErr =  'Files not found please Try again, if persistes contact us';
		}

		if(!empty($_POST['taglineTxtBx'])){
			$tagline = htmlspecialchars($_POST['taglineTxtBx']);

			if($formStat){
					$formStat  = true;
				}
		} else {
			$tagErr = 'Please add a tagline, this is for display purposes';

			$formStat = false;
			
		}

		if($userDetails->level == 99){
			$isValid = 'Y';
		} else {
			$isValid = 'N';
		}

		

		
		if($formStat){
			$article = new Article(	$artId,
									$headline,
									$nameArr[0],
									$user,
									null,
									null,
									$finalImgPth,
									$tagline,
									$isValid
									);
			

			
			insert($article, 'upload');
			
		} else {

			$upldFrmErr = 'Errors preset with your upload, please select upload to option to see details';

			echo '<script> var hdLnErr = "' . $hdLnErr . '";
					var artFlErr = "'. $artFlErr . '";
					var thmbErr = "'. $thmbErr . '";
					var tagErr = "' . $tagErr . '";
					var upldErr = "'. $upldFrmErr .'";
					var headline ="'. $headline. '";
					var tagline ="'. $tagline. '";
					</script>';

			
		}
	}

	function createForm(){
		//linked to the second disabled button
	}

	function insert($article, $InserType){

		$inArt = new Article();

		$res = $inArt->insertArticle($article);

		if($res[1]){
			$message = new Message('Article has been uploaded, an email will be sent once it has been vetted', 'info');
			$message->addMessageToSession();
			header('location:index.php');
		} else {
			// if( $res == 'upload'){
			// 	echo '<script type="text/javascript">
			// 		alert("There has been a problem with the saving of your article, please click ok and go back to the upload article screen");
			// 	</script>';
			// } else {
			// 	echo '<script type="text/javascript">
			// 		alert("There has been a problem with the saving of your article, please click ok and go back to create article screen");
			// 	</script>';
			// }

			echo $res[0];
		
		}
			

		}
			
	
	
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

  <head>
		<title>Royalflush</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
			<link rel="stylesheet" href="css/theme.css">
			<link rel="stylesheet" href="css/dropzone.css">


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>	

  
	
</head>

  <body>
	
	  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- sets up the menu toggle when page is viewed on a small screen id mobile. -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navOptions">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
									</button>
					<a class="navbar-brand" href=".">Royalflush</a>
					<!-- adds the home logo link to bar -->
				</div>
				<!-- adds the navigation links -->
				<div class="collapse navbar-collapse" id="navOptions">
					<ul class="nav navbar-nav">
						<li><a href="#">About</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li id="reg"><a href="Register.php"
									data-toggle="tooltip" 
									data-placement="bottom" 
									title="Register"><span class="glyphicon glyphicon-user"></span></a></li>
						<li id="login"><a href="LoginPage.php?page=<?php echo $page; ?>" 
									data-toggle="tooltip" 
									data-placement="bottom" 
									title="Log In">
								<span class="glyphicon glyphicon-log-in"></span></a></li>
						<li id="logout"><a href="plugins/logout.php?page=<?php echo $page; ?>" 
									data-toggle="tooltip" 
									data-placement="bottom" 
									title="Log Out">
								<span class="glyphicon glyphicon-log-out"></span></a></li>
						
					</ul>
				</div>
				<div class="row" id="artNavbar" hidden="true">
					<div class="navbar-header" >
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#artOptions">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
									</button>
					<a class="navbar-brand" href="#">Insert Option</a>
					<!-- adds the home logo link to bar -->
				</div>

					<div class="collapse navbar-collapse" id="artOptions">
					<ul class="nav navbar-nav">
						<li id="btnTxtBx"><a href="#" class="btn-success">Text</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle btn-success" data-toggle="dropdown" href="#" id="btnPicChoice"> 
												Picture
												<span class="caret"></span>
											</a>
							<ul class="dropdown-menu" id="picDropDown">
									<li><a href="#" tabindex="-1">Stand Alone</a></li>
									<li><a href="#" tabindex="-1">Inline Right</a></li>
									<li><a href="#" tabindex="-1">Inline Left</a></li>
							</ul>
						</li>
						<li id="btnLnkBx" class="btn-success"><a href="#">Link</a></li>
						<label id="lnkMsg" class="text-warning"></label>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li id="btnUndo"><a href="#"
									data-toggle="tooltip" 
									data-placement="bottom" 
									title="Register"
									class="btn-success">Undo</a></li>
						
					</ul>
				</div>


			</div>
  
	  </nav>

	  <div class="container" id="choiceDiv">
		<p>Welcome to the article createtion pages!! </br> There are two options to 
				getting you article onto our site, upload and create.</p>
		<p>Uploading is for those who already have a existing html page for 
			their article. It allows you to upload your page to our site and once approved 
			it will be displayed. The other option create is for those who may not be fully
			comfortable with HTML language, so we have created a simple but effective tool for
			creating articles of your choice. Again same story once completed and submitted 
			it will be vetted and approved. </p>
			<p>Note on approval criteria, this will be checked for any subjects deemed not 
				appropriat for our site eg racial, hateful etc. Also these will be checked for
				malious code, especially users that use the uploaded form, so please keep the JS
				a minimum if any at all.</p>
				<p>Now after all that please choose you method and we look forward to hearing
					what you have to say.
					</br> RFO.
				</p>

		<div class="btn-group col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4
								col-xl-4 col-xl-offset-4 col-sm-4 col-sm-offset-4" role="group">
			<button class="btn btn-success" id="uploadBtn" onclick="openPnl(this)">Upload</button>
			<button class="btn btn-success disabled" id="createBtn" onclick="openPnl(this)"
					>Create</button>
			
		</div>
		<br/>
		<br/>

		<div class=" col-md-offset-2 col-lg-offset-2 col-xl-offset-2 col-sm-offset-2">
			<p id="upldFrmErr" class="text-warning"></p>
			<script>
					$('#upldFrmErr').text(upldErr);
			</script>
		</div>

		

		<!--<div class="col-md-2 col-md-offset-1">
			<button class="btn btn-success" id="createBtn">Create</button>
		</div>-->

	</div>


	<div class="container" id="uploadDiv" hidden="true">
		<form class="form-horizontal" method="post" action="articleEditing.php" enctype="multipart/form-data">
			<div class="panel col-md-10 col-md-offset-1" id="uploadPnl">

				<div class="col-sm-offset-11 col-xs-offset-11 ">
					<a role="button" id="clsUpPnl" onclick="closePnl(this)"><span class="glyphicon glyphicon-remove"></span></a>
					<input type="hidden" name="pnlType" id="pnlType">
				</div>

				<div id="formContent">
					
				</div>

				<!--<div class="form-group">
						<label class="control-label col-md-3" for="headline">Headline</label>
						<div class="col-md-8">
							<input type="text" class="form-control" id="headline" name="headline" placeholder="Add headline here" value="<?php echo $headline; ?>">
						</div>
					</div>

				<div class="form-group">
							<label class="control-label col-md-3" for="artFile" id="artFileLbl">Article Content - </br> (Upload .HTML files only)</label> 
							<div class="col-md-6">
								<input type="file" name="artFile" id="artFile" class="form-control-file" onchange="uploadArticle(this)">
								<img src="images/site-images/file-uploads/appbar.page.check.png" class="img" id="artFileUpload" hidden="true">
								<input type="hidden" name="artText" id="artText" class="form-control">
							</div>
							<label id="artFileErr" class="control-label"></label>
				</div>

				<div class="form-group">
							<label class="control-label col-md-3" for="thmbnlPic" id="thmbnlPicLbl">Thumbnail</label> 
							<div class="col-md-6">
								<input type="file" name="thmbFile" id="thmbFile" class="form-control-file" onchange="imgPost()">
							</div>
							<label id="thmbErr" class="control-label"><?php //echo $thmbErr; ?></label>
				</div>

				<div class="form-group">
						<label class="control-label col-md-3" for="taglineTxtBx">Tag Line</label>
          <div class="col-md-6">
            <textarea class="form-control" id="taglineTxtBx" placeholder="Preview text ie tagline here"
    									name="taglineTxtBx" value="<?php //echo $tagline; ?>"></textarea>
						</div>
				</div>-->

		<!-- <div class="form-group" id="iRobot">
				<div class="col-md-10 col-md-offset-4" id="recaptchaDiv">
					<div class="g-recaptcha" data-sitekey="6LeEhiMUAAAAAI2RhHbWDCwbJhNtxKiKRmk0Zzki"
								data-theme="dark" data-callback="iRobot"></div>
				</div>
			</div> -->
		<!-- <div class="form-group" id="rstBtnDiv" hidden="true">
			<div class="col-md-10 col-md-offset-4">
              <a role="button" id="rfshRct" onclick="refreshRecp(this)">
			  	<img src="images/site-images/file-uploads/appbar.refresh.png" id="refreshImg" class="img">
			</a>
            </div> -->
		</div>			
          <div class="form-group" id="submitButton">
           	 <div class="col-md-10 col-md-offset-4">
              <input type="submit" class="btn btn-success" value="Submit" 
							name="sbmtBtn" id="sbmtBtn">
            </div>

				
			</div>
		</form>
	</div>

  	<!-- <div class="container" id="createDiv" hidden="true"> -->
			
			<!--<div class="row">
	
				<form class="form-horizontal" id="artForm" style="padding: 100px" method="post" action="https://localhost:8888/testing/articleEditing.php">
					
					
					
					<div class="panel col-md-8 col-md-offset-1" id="artPnl">
						<div class="col-sm-offset-11 col-xs-offset-11 ">
							<a role="button" id="clsArtPnl" onclick="closePnl(this)"><span class="glyphicon glyphicon-remove"></span></a>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-2" for="headline">Headline</label>
							<div class="col-md-10">
								<input type="text" class="form-control" id="headline" placeholder="Add headline here" onchange="updateArr(this,2)">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2" for="headLnPic" id="headLnPicLbl">Title Picture</label> 
							<div class="col-md-6">
								<input type="file" name="headLnPic" id="headLnPic" class="form-control-file" onchange="updateArr(this,5)">
                                <label><input type="checkbox" onchange="removePic()" id="headLnPicChkBx">Check to Remove</label>
							</div>
						</div>
						
					</div>
					
					
				</form>
			</div>-->
		<!-- </div> -->

		<!-- <div class="col-md-4 col-md-offset-1" hidden="true" id="preDiv">
				<button role="button" class="btn btn-success" id="preBtn" >
					Preview
				</button>
		</div>
			
		<div class="row">
				<p id="runOrd">
					
				</p>
				<div class="panel panel-default" id="preVwPnl" hidden="true">
					
				</div>
		</div> -->
				
			
			
		
		</div>
		
  </body>
	<script src="js/login.js"></script>
	<script src="js/articleEdit.js"></script>
	<script src="js/articleForms/upload.js"></script>
	<script src="js/recaptcha.js"></script>
	<!--<script src="js/articleForms/create.js"></script>-->
</html>