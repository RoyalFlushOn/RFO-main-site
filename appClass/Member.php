<?php 

  include 'appClass/Autoloader.php';

  class Member{
    
    private $firstName;
    private $lastName;
	  private $dob;
    private $email;
    private $disPic;
    private $userName;
    private $password;
	  private $creation;
	  private $status;
	  private $level;
    
    
    
    
    
    function __construct(){
      $a = func_get_args();
			$i = func_num_args();
			
			if(method_exists($this, $f='__construct'.$i)){
				call_user_func_array(array($this,$f), $a);
			}
   	 }
    
    
		function __construct0(){
			//generic constructor
		}

		function __construct2($a1, $a2){
      $this->firstName = $a1;
      $this->email = $a2;
      $this->status = password_hash($a2, PASSWORD_DEFAULT);
    }
		
		function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7){
      $this->firstName = $a1;
      $this->lastName = $a2;
			$this->dob = $a3;
      $this->email = $a4;
      $this->userName = $a5;
			$this->password = $a6;
			$this->creation = date('Y-m-d');
      $this->status = password_hash($a4, PASSWORD_DEFAULT);
			$this->level = '10';
			$this->disPic = $a7;
    }
    
     function __construct9($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9){
      $this->firstName = $a1;
      $this->lastName = $a2;
			 $this->dob = $a3;
      $this->email = $a4;
      $this->userName = $a5;
			$this->creation = $a6; 
      $this->status = $a7;
			$this->level = $a8;
			$this->disPic = $a9;
			 
			 //$this->password = 'null';
    }
    
     //check a username existes in the system already
     function userCheck($user){
      
       $this->dtAcc = new DataAccess();
      
       $this->chkUsr = $this->dtAcc->usrChk($user);
       
      if(!is_null($this->chkUsr)){
        return true; 
      }else{
        return false;
      }
    }
    
     //check and validates a password being entered into the system
     function passCheck($pass, $user){
      
      $this->dtAcc = new DataAccess();
      $this->chkPass = $this->dtAcc->passRtv($user);
      
      if (password_verify($pass, $this->chkPass)){
        return true;
      }else{
        return false;
      }
    }
    
    //checks if a current registering guest's email isnt already in the system.
     function emailCheck($email){
       
       $this->dtAcc = new DataAccess();
       
       $chkemail = $this->dtAcc->srchEmail($email);
       
       if ($chkemail != null){
         if($chkemail == $email){
           return true;
         } else {
           return false;
         }
       } else {
         return false;
       }
       
     }
     
    //creates a registered member.
    function registerUser($member){
      
			$insert = 'INSERT INTO Users VALUES("'. $member->getFirstName() . '","' .  $member->getLastName() . '","' . $member->getDOB() . '","' . $member->getEmail() . '","' . $member->getUsername() . '","' . $member->getPassword() . '","'. $member->getCreation() . '","' . $member->getStatus() . '","' . $member->getLevel() . '","' . $member->getDisPic() . '")';
			
			//return $insert;
			$dtAcc = new DataAccess();
      $dtAcc->insertStatement($insert);
    }
				
		//send out a activation email via the PHPMailer api. I add 2 bodies one with html and a button to click and one that is just text with a link to copy and paste. The paramiter $a1 is the email address of the person needing this activation email.		
		public function sendAct($a1){
					
					$hash = password_hash($a1, PASSWORD_DEFAULT); // encrypts the email for the activation string.
					$dtAcc = new DataAccess();
					
					$dtAcc->insertStatement("UPDATE Users SET Status = '" . $hash . "' WHERE email = '" . $a1 . "'"); //update the database with activation code. 
			
			
			
			$mainBody = '<!DOCTYPE html>
<html>

<head>
  <title>Activation</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
  
 <body>
   <div class="container">
     <div class="col-md-6 col-lg-4">
       Welcome to our small collective, resistence is futile. Your are nearly finished the registration process, please click the activation button to complete this process.
       </br><br/>

     <a href="www.royalflush.online/activation.php?act=' . $hash . '&email=' . $a1 . '&vld=' . time() . '" class="btn btn-success">Activate</a>
     </br><br/> 
   <small>It should be noted that the activation is only valid for 30 minutes and should this time out. please return to the main website and log in. This act triggers another activation.</small>
     </div>
   </div>
  </body> 
</html>';
				
				$altBody = '(You are seeing this due an error in dispaying the HTML messgage)
				
Welcome to our small collective, resistence is futile. Your are nearly finished the registration process, please copy and paste the activation link below to complete the registration process.

Link: www.royalflush.online/activation.php?act=' .  $hash . '&email=' . $a1 . '&vld=' . time() . '
Please note that the activation process can time out, if this happens you simply need to log in and this will trigger another activation email.';
				
			
				// Add the body, back up body and the email address fromt he server wish to be used and the email of where it is going.
 			$email = new Email("admin@royalflush.online",
 												'RoyalFlush',
 												$a1,
 												$this->firstName,
 												'Complete Registration',
 												$mainBody,
 												$altBody);
			
 			return $email->sendEmail();
			
			//return $mainBody; //testing purposes 
		}
		
		//used to send out a email that can be used to trigger the reset of password. If sends two strings, one is a small HTML page with link button that takes you to the required page to complete this. The second string is just a plain text with the link you need with to paste into the browser.
		//The paramiters passed in are strings with validation string($a1) and email($a2).
		public function sendResetmail($a1, $a2){
			
			
			
			$mainBody = '<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
  <title>Activation</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!-- 		 <link rel="stylesheet" href="css/theme.css"> -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  <style>' .
// 				. $css->getTemp() . 
//     body {
//       margin: 70px;
//     }
  '</style>
</head>
  
 <body>
   <div class="container">
     <div class="col-md-6 col-lg-4">
       Please click the button below to reset you password, any problems as alwasy please contact support@royalflush.online.
       </br><br/>
     <a href="www.royalflush.online/forgotPassword.php?vstr=' . $a1 . '&ver=' . $a2 . '&npsw=true" class="btn btn-success">Reset Password</a>
     </br><br/> 
   <small>It should be noted that the password reset is only valid for 30 minutes and should this time out. please return to the main website and go to log in page. Then click on the forgot password button.</small>
     </div>
   </div>
  </body> 
</html>';
				
				$altBody = '(You are seeing this due an error in dispaying the HTML messgage)
				
Please click the button below to reset you password, any problems as alwasy please contact support@royalflush.online.

Link: www.royalflush.online/forgotPassword.php?vstr=' . $a1 . '&ver=' . $a2 . '&npsw=true' . time() . '
Please note that the rest password process can time out, if this happens you simply need to log in page and click forgot passord button again.';
				
			
 			$email = new Email("admin@royalflush.online",
 												'RoyalFlush',
 												$a2,
 												$this->firstName,
												'Complete Registration',
 												$mainBody,
 												$altBody);
			
 			return $email->sendEmail();
			
	//		return $mainBody; //for testing purposes.
		}
		
		//verifyAct takes a passed in a string($act) that is verification process, the second paramiter takes a string value for the email($eml), this is used to query the database and retrieve the stored verification string.
		public function verifyAct($act, $eml){
			$dtAcc = new DataAccess();
			
			$temp = $dtAcc->userActRetrive($eml); //retrive from the database the activation string that matches the passed in email.
			
				//previous method used to retieve data from query result.
// 			foreach( $temp as $res){
				
// 				$curAct = $res['status'];
// 			}
			
			$curAct = $temp->fetch(PDO::FETCH_OBJ);
			
			if($curAct->status === $act){
				return true;
			} else {
				return false;
			}
			
		}
		
		//verifyFP takes a passed in password change authentication string($verify), then using the passed in email string($email) the database is queried for the stored verification string. These are then compared and pending on the result a boolean is returned to the calling object.
		public function verifyFP($verify, $email){
			$dtAcc = new DataAccess();
			
			$temp = $dtAcc->returnQuery("SELECT password FROM Users WHERE email = '" . $email . "'");
			
			$res = $temp->fetch(PDO::FETCH_OBJ);
			
			if($verify === $res->password){
				return true;
			} else {
				return false;
			}
		}
		
		//Using the passed in string($eml) as the members email address, that is then used to apply to the UPDATE query passed to the DataAccess object.
		public function activateAcc($eml){
			
			$dtAcc = new DataAccess();
			
			$dtAcc->nonReturnQuery('UPDATE Users SET status = "verified" WHERE email = "' . $eml . '"');
		}
		
		//udates the current password with a new password entered by the user, this achieved by using the passed in strings as the new password($newPass) and the username($user) to give the specific database row that needs to be altered.
		 function changePassword($newPass, $user){
			
			$dtAcc = new DataAccess();
			
			$stat = $dtAcc->passChng($this->passEncrypt($newPass), $user);
			
			return $stat;
		}
		
		//resets the pass word and send out an email.
		public function resetPass($email){

			$dtAcc = new DataAccess();
			
			$temp = $this->passEncrypt(time());
			
			//$dtAcc->passRestQuery("testing", $email);// testing purposes
			
 			$dtAcc->passRestQuery($temp, $email);
			
 			$this->sendResetmail($temp, $email);
			//return "forgotPassword-test.php?vstr=testing&ver=" . $email . "&npsw=true"; // for testing
			}
    
    //validates a date of birth by the user and returns the appropriate error message if
		//wrong.
    function validateDob($day, $month, $year){
      
      $inRng = false;
			$rngDate = array(4,6,9,11);
      
      foreach ($rngDate as $rng){
        if ($month == $rng){
          $inRng = 'true';
        }
      }
      
      if($inRng){
        if($day <= 30 ){
          return 'true';
        } else {
          return '30MtD';
        }
      } else if($month == 2){
        if($day == 29 ){
          if(($year % 4) == 0){
            return 'true';
          } else {
            return 'lpYr';
          }
        } else if($day <= 28){
          return 'true';
        } else {
          return 'lpYrD';
        }
      } else {
        return 'true';
      }
    }
    
    //takes a password and encrypts it
    function passEncrypt($pass){
      return password_hash($pass, PASSWORD_DEFAULT);
    }
		
		//
     function getUserData($userNm){
			$dtAcc = new DataAccess();
			return $dtAcc->getUserData($userNm);	
		}
		
		
    function getUsername(){
      return $this->userName;
    }
    
    function getFirstName(){
      return $this->firstName;
    }
    
    function getLastName(){
      return $this->lastName;
    }
    
    function getEmail(){
      return $this->email;
    }
		
		function getPassword(){
      return $this->password;
    }
		
		function getLevel(){
      return $this->level;
    }
		
		function getStatus(){
      return $this->status;
    }
		
		function getDisPic(){
      return $this->disPic;
    }
		function getDOB(){
			return $this->dob;
		}
		
		function getCreation(){
			return $this->creation;
		}
    
//     function setFirstName($firstName){
//       $this->firstName = $firstName;
//     }
    
//     function setLastName($lastName){
//       $this->lastName = $lastName;
//     }
    
//     function setEmail($email){
//       $this->email = $email;
//     }
    
//     function setDob($dob){
//       $this->dob = $dob;
//     }
    
//     function setUser($userIn){
//       $this->userName = $userIn;
//     }
  }

 ?>

  

