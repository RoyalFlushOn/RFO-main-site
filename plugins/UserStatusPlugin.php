<?php

function pageloadUserCheck(){

  $jsonStrResult = `{
    "result" : {
      "login" : " ",
      "regStat" : " "
    }
  }`;

  $result = json_decode($jsonStrResult);

  if(isset($_SESSION['user'])){

    $user = json_decode($_SESSION['user']);

    if($user->status == 'verified'){
      $result->login = 'true';
      $result->regStat = 'true';
    } else {
      $result->login = 'false';
      $result->regStat = 'false';
    }
  } else {
    $result->login = 'false';
    $result->regStat = 'false';
  }

  return $result;
}
?>