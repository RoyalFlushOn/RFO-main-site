<?php

function pageloadUserCheck(){

  $jsonStrResult = `{
      "login" : "false",
      "regStat" : "false"
  }`;

  $result = json_decode($jsonStrResult);

  if(isset($_SESSION['user'])){

    $user = json_decode($_SESSION['user']);

    if($user->status == 'verified'){
      $result->login = 'true';
      $result->regStat = 'true';
    } else {
      $result->login = 'true';
      $result->regStat = 'false';
    }
  } else {
    $result->login = 'false';
    $result->regStat = 'false';
  }

  if($result->login){
			
    if($result->regStat){
      
      $loginStat = '<script> loginNavBtnConfig("logged");</script>';	
    } else {
      $loginStat = '<script> loginNavBtnConfig("registration");</script>';
      $regStat = '<div class="alert alert-warning fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Notice</strong> This account is registered but not activated. Please check email or click on this link, <a href="activation.php">Activate</a>
    </div>';
      }
  } else {
    
    $loginStat = '<script> loginNavBtnConfig("default");</script>';
  }

  $page = htmlspecialchars($_SERVER['PHP_SELF']);
	
	echo $regStat;

  return $result;
}
?>