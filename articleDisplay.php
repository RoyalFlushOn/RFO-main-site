<?php
session_start();
require('appClass/Autoloader.php');
require('plugins/SetupPage.php');

$search = false;

if(isset($_GET['id'])){

  $id = htmlspecialchars($_GET['id']);

} else {
  $search = true;
}


include('plugins/CommentsPlugin.php');
        
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

    <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
        crossorigin="anonymous">
   <link rel="stylesheet" href="css/theme.css">


  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
			    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
          integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
          crossorigin="anonymous"></script>

</head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar" name="navbar">
  </nav>
  	<div class="container" id="articleContent">
    </div>
    
  </body>
  <script src='js/navbar.js'></script>
  <script src='js/articleDisplay.js'></script>
  <?php if($search){
          echo "<script> search(); </script>";     
        } else {
          echo "<script> getArticleContent('". $id ."'); </script>";
        }
  ?>
</html>