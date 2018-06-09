<?php
session_start();
require_once '../appClass/Autoloader.php'; 

  if(empty($_POST['request'])){
    
    $responce->status = 'default';
    echo json_encode($responce);
  } else {
    switch($_POST['request']){
      case 'status':
        returnUserStatus();
        break;
      case 'logout':
        logUserOut();
        break;
      case 'location':
        setLocation($_POST['location']);
    }
    
  }

  function returnUserStatus(){

    if(isset($_SESSION['user'])){

      $user = json_decode($_SESSION['user']);
  
      if($user->status == 'verified'){
        $responce->status = 'login';
        echo json_encode($responce);
      } else {
        $responce->status = 'registration';

        $message = new Message('This account is registered but not activated. Please check email or click on this link, <a href="activation.php">Activate</a>', 'warning');
        $message->addMessageToSession();
        
        echo json_encode($responce);
      }
    } else {
      $responce->status = 'default';
      echo json_encode($responce);
    }

  }

  function logUserOut(){

    if(isset($_SESSION['user'])){
      unset($_SESSION['user']);
    } 

    $responce->status = 'success';

    $message = new Message('You have been logged out successfully', 'success');
    $message->addMessageToSession();
    
    echo json_encode($responce);
  }

  function setLocation($location){
      if(isset($_SESSION['login_location'])){
        unset($_SESSION['login_location']);
      }

      $_SESSION['login_location'] = $location;
      $responce->location = $location;

      echo json_encode($responce);
  }


  // if(isset($_SESSION['user'])){

  //   $user = json_decode($_SESSION['user']);

  //   if($user->status == 'verified'){
  //     $result->login = true;
  //     $result->regStat = false;
  //   } else {
  //     $result->login = true;
  //     $result->regStat = false;
  //   }
  // } 

  // if($result->login){
			
  //   if($result->regStat){
      
  //     $loginStat = '<script> loginNavBtnConfig("logged");</script>';	
  //   } else {
  //     $loginStat = '<script> loginNavBtnConfig("registration");</script>';
  //     $regStat = '<div class="alert alert-warning fade in">
  //     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  //     <strong>Notice</strong> This account is registered but not activated. Please check email or click on this link, <a href="activation.php">Activate</a>
  //   </div>';
  //     }
  // } else {
    
  //   $loginStat = '<script> loginNavBtnConfig("default");</script>';
  // }

  // $page = htmlspecialchars($_SERVER['PHP_SELF']);
	
	// echo $regStat;

  // return $result;
?>