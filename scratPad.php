<?php // session_start();
// 	include "appClass/Autoloader.php" ?>

<html>

 <?php 
	//namespace Emojione;
	// session_start();
	
	// session_destroy();

	// if(!$_GET['npsw'] == null ){
	// 	  echo 'found get';
	//   } else {
	// 	  header("Location:index.php?msg=Ooow+sorry+that+is+not+allowed.+Bye&type=info");
	//   }
?>
	
	<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="css/theme.css">

	        
		<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
		
				
	</head>
  
  <body>

		<div class="container">
	    
      <div class="panel panel-default">
        <div class="panel-body" style="background-color:#f7f7f9; color:black">
          <div id="editor"></div>
        </div>
      </div>
</div>
		
		
	
  </body>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
	<!--<script src="js/site.js"></script>-->
  
  <?php
    echo password_hash('Password1', PASSWORD_DEFAULT);
  ?>
  
   <script>
      var quill = new Quill('#editor', { theme: 'snow' });
    </script>
	
</html>