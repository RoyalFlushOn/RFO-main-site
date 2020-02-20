<?php session_start();
	require('appClass/Autoloader.php');
  require('plugins/SetupPage.php');

  $server = $_SERVER['SERVER_NAME'];

  $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/private/recaptcha.json");
  $_SERVER['DOCUMENT_ROOT'] ."/private/recaptcha.json";

  $obj = json_decode($json);

  $recaptDetails = new RecaptDetails();

  switch ($server){
    case "localhost":
        $recaptDetails = $obj->dev;
      break;
    case "RFO_UAT-gavinvmitchell345269.codeanyapp.com":
        $recaptDetails = $obj->sit;
    break;
    case "www.royalflush.online":
        $recaptDetails = $obj->prod;
    break;
  }

	$user = $userDetails = $headline = $tagline = $page = $finalImgPth = $artFilePath = $imagePath = $url =  $finalArtFile = '';

	$hdLnErr = $thmbErr = $tagErr = $upldFrmErr = $artConErr = '';

	$fileNms = $tmpLoc = $errors = array();

	$formStat = false;

	if(isset($_SESSION['user'])){

		$temp = $_SESSION['user'];
		$userDetails = json_decode($temp);

		if($userDetails->level != 99){

			$message = new Message('You must have the right user level to access page, if you wish to please contact admin@royalflush.online.', 'info');
			$message->addMessageToSession();
			header('location: index.php');
	
		}

	} else {

		$message = new Message('Sorry you must logged in to use this page.', 'warning');
		$message->addMessageToSession();
    
		header('location: index.php');
	
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    uploadForm();
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
		$userDetails = json_decode($_SESSION['user']);
		$json = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/private/paths.json');
		$paths = json_decode($json);
		$articlePaths = $paths->articles;
		
		$articleID = new Article();
		echo 'article id: ' . $artId = $articleID->createID();
    

		$user = $userDetails->user;
		$userDetails->level;

		if(!empty($_POST['articleTitleTxtBx'])){
			$headline = htmlspecialchars($_POST['articleTitleTxtBx']);

			$formStat = true;
      echo 'title passed </br>';
		} else {
			echo $hdLnErr = 'Please enter the headline of your article please.';

			$formStat = false;
      echo 'title failed </br>';
		}
    
    if($_POST['artTmbChoice'] == 'url'){
      echo 'this is an URL </br>';
      if(!empty($_POST['articleThumbnailUrl'])){
         echo 'url post is not empty </br>';
        $url = filter_var($_POST['articleThumbnailUrl'], FILTER_SANITIZE_URL);
        echo '$url </br>';
        if(!filter_var($url, FILTER_VALIDATE_URL) === false){
          echo $dbImagePath = $url;
        } else {
          $formStat = false;
        $thmbErr =  'There is an issue please review your URL for proper formating.';
        }
      } else {
        $formStat = false;
        $thmbErr =  'Please make sure there is a link present if';
      }
    } else if($_POST['artTmbChoice'] == 'file') {
      if(!empty($_FILES['articleThumbnailFile'])){

			$nameArr = $_FILES['articleThumbnailFile']['name'];
			$tmp_name = $_FILES['articleThumbnailFile']['tmp_name'];
			$errArr = $_FILES['articleThumbnailFile']['error'];
			$size = $_FILES['articleThumbnailFile']['size'];
      
			if(getimagesize($tmp_name)){

				$imagePath = $baseDir. '/'. $articlePaths->images .'/' . $user;

				if(!is_dir($imagePath)){
					mkdir($imagePath, 0775);
				}

				$imagePath = $imagePath . '/' . $artId;

				if(!is_dir($imagePath)){
					mkdir($imagePath, 0775);
				}

				$finalImgPth = $imagePath . '/' . $nameArr;
		

				if($formStat){
					if(move_uploaded_file($tmp_name, $finalImgPth)){
						$formStat  = true;
            echo 'pic passed </br>';
						$dbImagePath = $articlePaths->images .'/' . $user . '/' . $artId . '/' . $nameArr;
					} else {
						$formStat = false;
            echo 'pic failed upload </br>';

						$thmbErr = 'Error with file uploading please try again. If persists please contact admin.';

					
					}
				}
			} else {
				$formStat = false;
        echo 'pic failed before upload </br>';

				$thmbErr ='Error with image, please ensure you have selected a image file.';
				
			}

			
		} else {
        $formStat = false;
        echo 'pic failed no file </br>';

        $thmbErr =  'Files not found please Try again, if persistes contact us';
      }
    } else{
      $formStat = false;
      $thmbErr =  'Please choose either file or url to uplaod with article please.';
    }

		

		if(!empty($_POST['articleTaglineTxtBx'])){
			echo $tagline = htmlspecialchars($_POST['articleTaglineTxtBx']);

			if($formStat){
					$formStat  = true;
          echo '</br> tag passed </br>';
				}
		} else {
			$tagErr = 'Please add a tagline, this is for display purposes';
      echo 'tag failed </br>';
			$formStat = false;
			
		}
    
    if(!empty($_POST['articleContent'])){
      $articleContent = $_POST['articleContent'];
      
      if($formStat){
					$formStat  = true;
          echo 'article content passed </br>';
				}
      
    } else {
      $artConErr = 'Please add text into the article before is it submitted for vetting';
      echo 'article content failed </br>';
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
									$articleContent,
									$user,
									null,
									null,
									$tagline,
									$dbImagePath,
									$isValid
									);
			

			
			insert($article, $userDetails->level, true, $finalImgPth);
//       var_dump($article); //testing
			
		} else {

			$upldFrmErr = 'Errors preset with your upload, please select upload to option to see details';

			echo '<script> var hdLnErr = "' . $hdLnErr . '";
					var artConErr = "'. $artConErr . '";
					var thmbErr = "'. $thmbErr . '";
					var tagErr = "' . $tagErr . '";
					var upldErr = "'. $upldFrmErr .'";
					var headline ="'. $headline. '";
					var tagline ="'. $tagline. '";
					</script>';

			
		}
	}


	function insert($article, $userLevel, $filePresent, $imagePath){

		$inArt = new Article();

		$res = $inArt->insertArticle($article, $userLevel);
    
    print_r($res);

		if($res->flag){
      
      if($userLevel == 99){
        $message = new Message('Article has been uploaded successfully, please review below\'s Article highlights.', 'success');
			  $message->addMessageToSession();
			  header('location: index.php');
      } else {
        $message = new Message('Article has been uploaded, an email will be sent once it has been vetted', 'info');
			  $message->addMessageToSession();
			  header('location: index.php');
      }
			
		} else {
			if($filePresent){
        removeFiles($imagePath);
      }
			if( $res == 'upload'){
				echo '<script type="text/javascript">
					alert("There has been a problem with the saving of your article, please click ok and go back to the upload article screen");
				</script>';
			} else {
				echo '<script type="text/javascript">
					alert("There has been a problem with the saving of your article, please click ok and go back to create article screen");
				</script>';
			}
		}
			

	}

	function removeFiles($image){
		try{
			unlink($image);
			rmdir(substr($image, 0, strrpos($image, '/')));
		}
		catch(Exception $ex){
			echo $ex->getMessage();
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
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BOOTSTRAP_CSS_THEME; ?>">
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
    
    <script src="https://kit.fontawesome.com/a56dda08bc.js"></script>

  
	
</head>

  <body>
	
	  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar" name="navbar">
			
	  </nav>

	  <div class="container" id="choiceDiv">
      <p><h3>Welcome to the article createtion pages!!</h3> </br> Please user the below editor to compose your article. Once completed and saved this will be 
       translated into a html page for you and displayed as once vetted.</p>
        <p>Note on approval criteria, this will be checked for any subjects deemed not 
          appropriat for our site eg racial, hateful etc.</p>
          <p>Now after all that please choose you method and we look forward to hearing
            what you have to say.
            </br> RFO.
          </p>
    </div>


    <div class="container" id="articleDiv">
      <form method="post" action="articleEditing.php" enctype="multipart/form-data" id="articleForm">

        <div class="form-group">
          <div class="col-md-8">
            <label class="control-label" for="articleTitleTxtBx">Article Title</label>
            <input type="text" class="form-control" name="articleTitleTxtBx" id="articleTitleTxtBx" placeholder="Please enter Article title"/>
            <label class="control-label" id="hdLnErr"><?php echo $hdLnErr; ?></label>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-4">
                  <label for="articleThumbnail">Article thumbnail</label>
                  <div class="row">
                    <div class="col-md-4">
                      <label class="control-label" id="articleThumbnailSubLbl">Format: </label>
                    </div>
                    <div class="col-md-8">
                      <div class="btn-group" role="group" id="articleThumbnailChoiceBtns">
                        <button type="button" class="btn btn-default" id="artThmbFileBtn">File</button>
                        <button type="button" class="btn btn-warning" disabled="disabled">or</button>
                        <button type="button" class="btn btn-default" id="artThmbURLBtn">URL</button>
                      </div>
                      <label class="control-label" id="formatLbl"></label>
                    </div>
                  </div>
              </div>
              <div class="col-md-8">
               <div class="row">
                   <div class="col-md-offset-11">
                        <a class="btn btn-default btn-sm" onclick="closeTumbnailChoice()" id="closeChoiceBtn">
                          <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </div>
                <div class="row">
                  <div class="panel panel-default" id="articleThumbnailPnl">
                    <div class="panel-body">
                        <input type="file" name="articleThumbnailFile" id="articleThumbnailFile" 
                               class="form-control-file" onchange="articleImgcheck(this)"/>
                        <input type="text" name="articleThumbnailUrl" id="articleThumbnailUrl" 
                               class="form-control" onchange="articleImageUrlCheck(this)"/>
                        <input type="hidden" name="artTmbChoice" id="artTmbChoice">
                    </div>
                    <div class="panel-footer" id="errorFooterPnl">
                         <label class="control-label" id="thmbErr"><?php echo $thmbErr; ?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> 
        </div>
        
        <div class="form-group">
          <div class="col-md-8">
            <label for="articleTaglineTxtBx">Article Summary/Tagline</label>
            <textarea name="articleTaglineTxtBx"  id="articleTaglineTxtBx" class="form-control"
                    placeholder="Here is where you will put a brief summery or hook that will be displayed in the search page and home page" rows="5"></textarea>
            <label class="control-label" id="tagErr"><?php echo $tagErr; ?></label>
           </div>
        </div>

        <div class="form-group">
          <div class="col-md-8">
            <label for="articleEditor">Article Content Editor</label>
          </div>
          <div id="articleEditor" style="background-color:#f2f3f2; color:black"></div>
            <input type="hidden" name="articleContent" id="articleContent">
            <label class="control-label" id="artConErr"><?php echo $artConErr; ?></label>
          </div>

        <button type="button" class="btn btn-default" id="articleSubmitBtn">
          Submit
        </button>
        <label class="control-label" id="upldFrmErr"><?php echo $upldFrmErr; ?></label>
      </form>
    </div>

<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
	<script src="js/login.js"></script>
<!-- 	<script src="js/navbar.js"></script> -->
	<script src="js/articleForms/upload.js"></script>
<!-- 	<script src="js/recaptcha.js"></script> -->
		
  </body>
  

</html>