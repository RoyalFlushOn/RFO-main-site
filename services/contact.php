<?php 
session_start();
require_once '../appClass/Autoloader.php'; 

$responce = new Responce();


if(!empty($_POST['subject'])){
  if(!empty($_POST['contact'])){
    if(!empty($_POST['content'])){
      
      $contact = new ContactUs($_POST['subject'], $_POST['contact'], $_POST['content']);
    
      if($contact->store()){
        $responce->status = true;
      } else {
        $responce->status = false;
      $responce->errormsg = 'store';
      }
    } else {
      $responce->status = false;
      $responce->errormsg = 'content';
    }
  } else {
    $responce->status = false;
    $responce->errormsg = 'contact';
  }
} else {
  $responce->status = false;
  $responce->errormsg = 'subject';
}

echo json_encode($responce);

?>