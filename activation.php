<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
  <title>Royalflush</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		 <link rel="stylesheet" href="css/theme.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  </head>

<body>
	
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- sets up the menu toggle when page is viewed on a small screen id mobile. -->
      <div class="navbar-header">
        <a class="navbar-brand" href=".">Royalflush</a>
              </div>

    </div>
  </nav>
  
    <div id="info-content" class="container">
    <div class="row">
      <div class="col-md-8 col-sm-6 col-lg-7">

<?php

include('appClass/Member.php');

if(isset($_GET['act'])){
  
  $mem = new Member();
  
  if(diffTime(date('h:i', $_GET['vld']))){
    if($mem->verifyAct($_GET['act'], $_GET['email'])){
      
      echo 'Account activated, you will redirected to home page in 5 seconds.';
      $mem->activateAcc($_GET['email']);
    
      header("refresh:5;url=index.php?msg=Registration is now complete, you are now able to log in.&type=success");
    
    } else {
      header("location:index.php?msg=(act)There is an error with you activaiton, please try the link again. If this message is seen again either log in again to prompt another activation email or contact support@royalflush.online&type=warning");
    }
} else {
    
     header('location:index.php?msg=(time)Your activation link has expired! Please either log in again to prompt another activation email or contact support@royalflush.online.&type=warning');
  }
    
} //else {
  
  
//   header('location:index-test.php?msg=Error!! Please access this page via link in your activation email.&type=warning');
//   //header('location:index.php?msg=error please access this page via link in your activation email&type=warning'); // production call
  
 
// }
				
if(isset($_GET['trigger'])){
	echo "past the first trigger check<br/>";
	if($_GET['trigger'] == "yes"){
		echo "past the second trigger check<br/>";
		if(isset($_GET['email'])){
			echo "into the main trigger part via email check<br/>";
			$member = new Member();
			
			$res = $member->sendAct($_GET['email']);
			echo "resenting of the act has worked<br><br/>";
			
			echo $res;
			
// 			header("Location: index-test.php?msg=Another Activation email associated with your account has been sent. Please check your email for the new actiation button, again please check you junk coz we do chat rubbish sometimes.&type=success");
			
		} else {
			
			header("Location: index.php?msg=Error has occured please log in and try again. If you this error persists please constact us on support@royalfluah.online.&type=warning");
			
		}		
	} else {
		
		header("Location: index.php?msg=Error has occured please log in and try again. If you this error persists please constact us on support@royalfluah.online.&type=warning");
	}
}

				if(!isset($_GET['act'])){
					if(!isset($_GET['trigger'])){
						header("Location: index.php?msg=You shall not pass, this page is only local people you are not welcome here.&type=warning");
					}
				}
  function diffTime($sesTime){
		
		$sesHr = substr($sesTime, 0, 2);
		$nowHr = substr(date('h:i'),0, 2);
		$sesMin = substr($sesTime, 3, 2);
		$nowMin = substr(date('h:i'),3, 2);
	
		if ($sesHr === $nowHr){
			$tot = $nowMin - $sesMin;
			
			if ($tot >= 30){
				return false;
			} else {
				return true;
			}
		} else {
			$diff = $nowMin + 60;
			
			$tot = $diff - $sesMin;
			
			
			if($tot >= 30){
				return false;
			} else {
				return true;
			}
		}
	}
        
        ?>
        
      </div>
      </div>
  </div>
  </body>
</html>
