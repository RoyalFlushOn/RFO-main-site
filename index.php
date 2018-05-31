<?php session_start();?>

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

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		 <link rel="stylesheet" href="css/theme.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 
  <?php 
  
  		
    include('appClass/Autoloader.php');
		include('plugins/CommentsPlugin.php');

  
  if(isset($_SESSION['message'])){
    $message = json_decode($_SESSION['message']);
    
    if($message->type != null){
      if($message->content != null){

        echo  '<div class="alert alert-' . $message->type .  ' fade-out">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Notice</strong> ' . $message->content .'
        </div>';
      } else {
        echo 'hmmm';
      }
    } else {
      //record in the log error with messages
      echo 'thats not right';
    }
    unset($_SESSION['message']);
		
  }
  
  $page = htmlspecialchars($_SERVER['PHP_SELF']);
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
					<li id="logout"><a href="" 
								 data-toggle="tooltip" 
								 data-placement="bottom" 
								 title="Log Out"
                 hidden="true">
							<span class="glyphicon glyphicon-log-out"></span></a></li>
					
				</ul>
				
      </div>

    </div>
  </nav>
  <!-- custom addition to bootstrap, business-header -->
  <header class="business-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="tagline">Royalflush Home Page </h1>
        </div>
      </div>
    </div>
  </header>

  <hr/>

  <div id="info-content" class="container">
    <div class="row">
      <div class="col-sm-8">
        <h2>RoyalFlush.Online is currently In Development</h2>
				<p>
					Our websites and various projects will be coming soon.If you wish to contact the admin team with any queries;
				</p>
<!--         <p> We are a group of people who have had ideas of a variable nature and like most procrastinated about for a while. This has annoyed us no end as it does most, so no more we say.</p>

        <p>In response to ‘no more’ we have create a central brand, which we are going to use to launch and advertise our ideas and events from.</p>

        <p>A feedback on anything on this page please don’t hesitate to let us know, via the right or various social media channels below.</p> -->
      </div>
      <div class="col-sm-4 well">
        <h2>Contact Us</h2>
        <address>
             Email - <a href="mailto:admin@royalflush.online">admin@royalflush.online</a>
              <br/>
					<a href="https://www.twitter.com/royalflushon_">@RoyalFlushOn_</a> - Twitter
                    <br/>
                    Facebook - <a href="https://www.facebook.com/royalflush.online">facebook/royalFlush</a>
            </address>
      </div>
    </div>

    <div id="main" class="col-md-8 col-sm-9">





      <!-- section for a sidebar could work here -->
    </div>

  </div>
  <?php include('plugins/articleTopThree.php'); ?>
  <hr/>

  <div class="row" id="newsFeed">
    <div class="col-sm-4">
      <img class="img-circle img-responsive img-center artImg" src="<?php echo $ra1['thumbnail']; ?>" alt="http://placehold.it/300x300"
        style="height:300px; width:300px;">
      <h2><?php echo $ra1['headline']; ?></h2>
      <p><?php echo $ra1['tagline']; ?>
      </p>
      <a role="button" class="btn btn-success" href="articleDisplay.php?id=<?php echo$ra1['article_id']; ?>">View Article</a>
    </div>
    <div class="col-sm-4">
      <img class="img-circle img-responsive img-center" src="<?php echo $ra2['thumbnail']; ?>" alt="http://placehold.it/300x300"
        style="height:300px; width:300px;"> 
      <h2><?php echo $ra2['headline'] ?></h2>
      <p><?php echo $ra2['tagline']; ?>
      </p>
      <a role="button" class="btn btn-success" href="articleDisplay.php?id=<?php echo$ra2['article_id']; ?>">View Article</a>
    </div>
    <div class="col-sm-4">
      <img class="img-circle img-responsive img-center" src="<?php echo $ra3['thumbnail']; ?>" alt="http://placehold.it/300x300" 
        style="height:300px; width:300px;">
      <h2><?php echo $ra3['headline'] ?></h2>
      <p><?php echo $ra3['tagline']; ?>
      </p>
      <a role="button" class="btn btn-success" href="articleDisplay.php?id=<?php echo$ra3['article_id']; ?>">View Article</a>
    </div>
  </div>
  
  <hr/>
  
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12 fb-comments" data-href="https://www.facebook.com/royalflush.online/" data-numposts="5">
<!--     <span class="fb-comments" data-href="https://www.facebook.com/royalflush.online/" data-numposts="5"></span> -->
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
    <a class="twitter-timeline" 
					 data-height="350"
					 data-theme="dark" 
					 href="https://twitter.com/RoyalFlushOn_">Tweets by RoyalFlushOn_</a>
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
    </div>
  </div>
	
	<hr/>
	
	<div class="row">
		<div class="col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-offset-3 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-body" style="height: 500px; overflow-x: hidden;">
				
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
      <p>&COPY; <?php echo date('Y'); ?> Royalflush </p>
    </footer>
  </div>
</body>


<script src="js/login.js"></script>
<?php //echo $loginStat; ?>
</html>