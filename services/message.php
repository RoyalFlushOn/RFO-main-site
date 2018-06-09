<?php 
session_start();
require_once '../appClass/Autoloader.php'; 

if(!empty($_POST['message'])){

    if(isset($_SESSION['message'])){
        
        unset($_SESSION['message']);
    }

    if(!empty($_POST['type'])){
        $type = $_POST['type'];
    } else {
        $type = 'info';
    }

    $message = new Message($_POST['message'], $type);

    $message->addMessageToSession();

    $responce->completed = true;

} else {
     $responce->completed = false;
     $responce->errorMsg = 'no messsage was sent with post';
}

echo json_encode($responce)
?>