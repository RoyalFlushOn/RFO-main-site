<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'Responce.php';



class Email{
  
  private $from;
  private $fName;
  private $to;
  private $HTMLbody;
  private $bodyAlt;
  private $subject;
  private $html = true;
  
  private $mail;  
  
  function __construct(){
    $a = func_get_args();
    $i = func_num_args();

    if(method_exists($this, $f='__construct'.$i)){
      call_user_func_array(array($this,$f), $a);
    }
  }
  
  
  function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7){
    
    $this->from = $a1;
    $this->fName = $a2;
    $this->to = $a3;
		$this->tName = $a4;
    $this->subject = $a5;
    $this->HTMLbody = $a6;
    $this->bodyAlt = $a7;
    
  }
  
  private function setSMTPServer(){
    
    $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/private/emailConfig.json");
    
    $obj = json_decode($json);
    $emailConfig = $obj->email;
    
    $this->mail = new PHPMailer(true);
    
    $this->mail->isSMTP();
    $this->mail->Host = $emailConfig->server;
    $this->mail->SMTPAuth = $emailConfig->SMTPAuth;
    $this->mail->Username = $emailConfig->Username;
    $this->mail->Password = $emailConfig->Password;
    $this->mail->SMTPSecure = $emailConfig->SMTPSecure;
    $this->mail->Port = $emailConfig->Port;
  }
  
  public function sendEmail(){
    
    $this->setSMTPServer();
    
    try{
		
      $this->mail->setFrom($this->from, $this->fName);
      $this->mail->addAddress($this->to, $this->tName);
      
      if ($this->html){
        $this->mail->isHTML($this->html);
        $this->mail->Subject = $this->subject;
        $this->mail->Body = $this->HTMLbody;
        $this->mail->AltBody = $this->bodyAlt;
      } else {
        $this->mail->Subject = $this->subject;
        $this->mail->Body = $this->HTMLbody;
      }
      
      $this->mail->send();
      
      $responce = new Responce();
      $responce->status = true;
      
      return json_encode($responce);
//       return true;
      
    } catch (Exception $e){
      
      $responce = new Responce();
      $responce->status = false;
      $responce->errMsg = $this->mail->ErrorInfo;
      
      return json_encode($responce);
      
//       return $this->mail->ErrorInfo;
      
    }
  }
}