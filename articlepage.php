<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		 <link rel="stylesheet" href="css/theme.css">
	<link rel="stylesheet" href="css/style.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 
  	<?php session_start();
	
				include('plugins/CommentsPlugin.php');
			//	include 'appClass/Member.php';
				include('plugins/UserStatusPlugin.php');
				include('appClass/Article.php');
	
				$login = pageload();
				$regStat = '';
			
				
			if($login['login']){
				if($login['regStat']){
					$loginStat = '<script>$("#login a").hide(); 
					$("#reg a").hide();</script>';	
				} else {
					$loginStat = '<script>$("#logout a").hide();</script>';
					$regStat = '<div class="alert alert-warning fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Notice</strong> This account is registered but not activated. Please check email or click on this link, <a href="activation.php">Activate</a>
			</div>';
				}
			} else {
				$loginStat = '<script>$("#logout a").hide();
				$("#login a").show();
				$("#reg a").show();</script>';
			}
	
	$page = $_SERVER['PHP_SELF'];
	
	$col = new Collection();
	$article = new Article();
	
	echo $regStat;
	
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		
		if(isset($_SESSION['articles'])){
			//$col = new Collection();
			
			$col = $_SESSION['articles'];
			
			if(!empty($col)){
				echo "from the session <br/>";
				
				$article = $col->getItem($id);
			} else {

				$dtAcc = new DataAccess();

				try{
					$temp = $dtAcc->returnQuery('SELECT * FROM Articles WHERE art_id = "' . $id . '"');

					$art = $temp->fetch(PDO::FETCH_OBJ);

					$article = new Article($art->art_id,
														 $art->title,
														 $art->content,
														 $art->username,
														 $art->entry
														);
					
					$col->addItem($article, $id);
					$_SESSION['articles'] = $col;
				}
				catch (Exeption $ex)
				{
					echo $ex->getMessage();
					}
				
		}
	} else {
			$dtAcc = new DataAccess();

		try{
			$temp = $dtAcc->returnQuery('SELECT * FROM Articles WHERE art_id = "' . $id . '"');

			$art = $temp->fetch(PDO::FETCH_OBJ);
			
			$article = new Article($art->art_id,
												 $art->title,
												 $art->content,
												 $art->username,
												 $art->entry
												);
			
			$col->addItem($article, $id);
			$_SESSION['articles'] = $col;
		}
		catch (Exeption $ex)
		{
			echo $ex->getMessage();
			}
		}
	} else {
		echo 'id not set <br/>';
	}
	
	
	
	
	
	if(isset($_GET['msg'])){
		$msg = htmlspecialchars($_GET['msg']);	 // look into alt as format
		$type = htmlspecialchars($_GET['type']); // of messages are changed
		
		echo  '<div class="alert alert-' . $type .  ' fade-out">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Notice</strong> ' . $msg .'
			</div>';
		
	}
	
	?>
	
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
        <a class="navbar-brand" href="."><span class="icon-royalflushHomeIcon"></span></a>
        <!-- adds the home logo link to bar -->
      </div>
      <!-- adds the navigation links -->
      <div class="collapse navbar-collapse" id="navOptions">
        <ul class="nav navbar-nav">
          <li><a href="about.php">About</a></li>
          <!--<li><a href="#">Contact Us</a></li>-->
          
        </ul>
				<ul class="nav navbar-nav navbar-right">
					<li id="login"><a href="loginPage.php?page=<?php echo $page; ?>" 
								 data-toggle="tooltip" 
								 data-placement="bottom" 
								 title="Log In">
							<span class="glyphicon glyphicon-log-in"></span></a></li>
					<li id="reg"><a href="register.php"
								 data-toggle="tooltip" 
								 data-placement="bottom" 
								 title="Register"><span class="glyphicon glyphicon-user"></span></a></li>
					<li id="logout"><a href="plugins/logout.php?page=<?php echo $page; ?>" 
								 data-toggle="tooltip" 
								 data-placement="bottom" 
								 title="Log Out">
							<span class="glyphicon glyphicon-log-out"></span></a></li>
					
				</ul>
      </div>

    </div>
  </nav>

  <?php echo $article->getMainText(); ?>
	
	<hr/>
	
	<div class="row">
		<div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-offset-3 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-body" style="height: 500px; overflow-x: hidden;">
			<?php 
				//include 'plugins/CommentsPlugin.php';
// 				echo commentsFeed('index', '0, 10');?>
				<p class="lead text-center bg-warning">
					Comming Soon a comments system for each page you can share your thoughts about that page or topic.
				</p>
			</div>
		</div>
		</div>
	</div>
	
	
	<hr/>

  <div class="row">
    <footer class="container">
      <p>&COPY; 2016 Royalflush </p>
    </footer>
            </div>
</body>

<?php echo $loginStat;  ?>
<script src="js/site.js"></script>

</html>