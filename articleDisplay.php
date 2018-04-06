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


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
	<?php
  
        include('appClass/Autoloader.php');
        include('plugins/CommentsPlugin.php');
				include('plugins/UserStatusPlugin.php');
	
				$login = pageloadUserCheck();
				$regStat = $loginStat = '';
	
			// if($login['login']){
			// 	if($login['regStat']){
			// 		$loginStat = '<script>$("#login a").hide(); 
			// 		$("#reg a").hide();</script>';	
			// 	} else {
			// 		$loginStat = '<script>$("#logout a").hide();</script>';
			// 		$regStat = '<div class="alert alert-warning fade in">
			// 	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			// 	<strong>Notice</strong> This account is registered but not activated. Please check email or click on this link, <a href="activation.php">Activate</a>
			// </div>';
			// 	}
			// } else {
			// 	$loginStat = '<script>$("#logout a").hide();
			// 	$("#login a").show();
			// 	$("#reg a").show();</script>';
			// }

  if(isset($_GET['id'])){

    $id = htmlspecialchars($_GET['id']);
    
    // $art = new Article();
    // $article = $art->getArticle($id);


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
        <a class="navbar-brand" href=".">Royalflush</a>
        <!-- adds the home logo link to bar -->
      </div>
      <!-- adds the navigation links -->
      <div class="collapse navbar-collapse" id="navOptions">
        <ul class="nav navbar-nav">
          <li><a href="#">About</a></li>
          <li><a href="#">Contact Us</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropDev"> 
                      Dev Pages
                      <span class="caret"></span>
                    </a>
            <ul class="dropdown-menu" id="devList">
              <li><a href="scratPad.php?page=<?php echo $page ?>">Scratch Pad</a></li>
              <li><a href="indexBootstrapDemo.html">Bootstap</a></li>
              <li><a href="LoginPage.php">Login</a></li>
              <li><a href="Register.php">Registration</a></li>
              <li><a href="examplePage.html">Example</a></li>
              <li><a href="twitterFeed.php">Twitter</a></li>
               <li><a href="canvasDemo.html">canvas</a></li>
              <li><a href="CommentsPlugin.php">comment</a></li>
            </ul>
          </li>
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

    </div>
  </nav>
  	<div class="container" id="articleContent">

      <?php //echo $article->getMaintext();
       ?>
    </div>
    
  </body>
<script src='js/articleDisplay.js'></script>
<?php echo "<script> getArticleContent('" . $id . "'); </script>" ; ?>
</html>