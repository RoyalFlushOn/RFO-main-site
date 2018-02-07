<?php
  
require 'email/PHPMailerAutoload.php';

class Email{
  
  private $from;
  private $fName;
  private $to;
  private $HTMLbody;
  private $bodyAlt;
  private $subject;
  
  private $server = 'n1plcpnl0104.prod.ams1.secureserver.net';
	private $SMTPAuth = true;
	private $Username = 'admin@royalflush.online';
	private $Password = 'FullHouse1985';
	private $SMTPSecure = 'ssl';
	private $Port = '465';
  private $html = true;
  
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
  
  public function sendEmail(){
    
		
		$mail = new PHPMailer;
		
		/*$mail->isSMTP();
		$mail->Host = $this->server;
		$mail->SMTPAuth = $this->SMTPAuth;
		$mail->Username = $this->Username;
		$mail->Password = $this->Password;
		$mail->SMTPSecure = $this->SMTPSecure;
		$mail->Port = $this->Port;*/
		
		$mail->setFrom($this->from, $this->fName);
		$mail->addAddress($this->to, $this->tName);
		$mail->isHTML($this->html);
		
		$mail->Subject = $this->subject;
		$mail->Body = $this->HTMLbody;
		$mail->AltBody = $this->bodyAlt;
		
		
		if(!$mail->send()){
			return array('status' => false, 'error' => $mail->ErrorInfo);
		} else {
			return array('status' => true);
		}
  }
}