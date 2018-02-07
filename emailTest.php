<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<?php
			require 'appClass/PHPMailerAutoload.php';
		
		$mail = new PHPMailer;
		
		$mail->isSMTP();
		$mail->Host = 'n1plcpnl0104.prod.ams1.secureserver.net';
		$mail->SMTPAuth = true;
		$mail->Username = 'admin@royalflush.online';
		$mail->Password = 'FullHouse1985';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';
		
		$mail->setFrom('admin@royalflush.online', 'Gavin');
		$mail->addAddress('gavin.v.mitchell@hotmail.co.uk', 'steve');
		$mail->isHTML(true);
		
		$mail->Subject = 'Test';
		$mail->Body = 'this is HTML mesg <b>smeg</b>';
		$mail->AltBody = 'non Html version';
		
		
		if(!$mail->send()){
			echo 'oops';
			echo '<br/> Error: ' . $mail->ErrorInfo;
		} else {
			echo 'boom sent, I think';
		}
?>

</body>
</html>