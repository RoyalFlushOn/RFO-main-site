<?php // session_start();
	include "appClass/Autoloader.php" ?>

<html>

 <?php 
	//namespace Emojione;
// 	session_start();
	
// 	session_destroy();

	// if(!$_GET['npsw'] == null ){
	// 	  echo 'found get';
	//   } else {
	// 	  header("Location:index.php?msg=Ooow+sorry+that+is+not+allowed.+Bye&type=info");
	//   }
    
    
//    unlink('images/articles/AR/bearded sckull.png');
//    rmdir('images/articles/user1');
// //     rmdir('images/articles/AR');
//         mkdir('images/articles', 0775);
    
    
    $setup = new SetupPage();
    
echo $setup->BOOTSTRAP_CSS_OFFLINE;
    
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
    
  ?>
  
   <script>
//       var quill = new Quill('#editor', { theme: 'snow' });
     
     $().ready(function(){
       
       let queryString = window.location.search
       queryString = queryString.substr(1)
       let firstSplit = queryString.split('&');
       
       if(firstSplit.length > 1){
         console.log("search error");
       } else {
        
         let finalSplit = firstSplit[0].split('=');
         
         if(finalSplit[0] === 'id'){
           let regex = /^[0-9a-zA-Z]+$/;
           let id = encodeURI(finalSplit[1]);
           
           if(id.match(regex)){
             console.log(id);
           } else {
             console.log('id error');
           }
           
         }
       }
       
     })
    </script>
	
</html>