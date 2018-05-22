<?php

  session_start();

  if(isset($_SESSION['user'])){

    unset($_SESSION['user']);
    
    if(isset($_GET['page'])){
      header('Location: ' . $_GET['page']);
    } else {
      header('Location: index.php');
    }
  } else {
    
    if(isset($_GET['page'])){
      header('Location: ' . $_GET['page']);
    } else {
      header('Location: index.php');
    }
  }



?>