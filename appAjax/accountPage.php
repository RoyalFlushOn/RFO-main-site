<?php
require_once 'appClass/Member.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  session_start();
  if(isset($_POST['passChk'])){
    //$user = $_SESSION['user']->getUsername();
    
//     $user = 'MrGavtastic'; //<- testing only 
    
    $member = new Member();
    
   // if($member->passCheck($_POST['passChk'], $user)){
    if($_POST['passChk'] === 'test'){
      echo 'true';
    } else {
      echo 'false';
    }
  }
  
  if(isset($_POST['passNew'])){
    
    $user = 'MrGavtastic'; //<- testing only
    //$user = $_SESSION['user']->getUsername();
    
    //$member = new Member();
    
//     echo $member->changePassword($_POST['passNew'], $user);
    
    echo 'Yeah';
  }
}

?>