<?php
session_start();
require_once '../appClass/Autoloader.php'; 

$responce = new Responce();

  if(empty($_POST['request'])){
    
    $responce->status = 'default';
    echo json_encode($responce);
  } else {
    switch($_POST['request']){
      case 'status':
        returnUserStatus($responce);
        break;
      case 'logout':
        logUserOut($responce);
        break;
      case 'location':
        setLocation($_POST['location'], $responce);
    }
    
  }

  function returnUserStatus($responce){

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

  function logUserOut($responce){

    if(isset($_SESSION['user'])){
      unset($_SESSION['user']);
    } 

    $responce->status = 'success';

    $message = new Message('You have been logged out successfully', 'success');
    $message->addMessageToSession();
    
    echo json_encode($responce);
  }

  function setLocation($location, $responce){
      if(isset($_SESSION['login_location'])){
        unset($_SESSION['login_location']);
      }

      $_SESSION['login_location'] = $location;
      $responce->location = $location;

      echo json_encode($responce);
  }
?>