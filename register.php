<?php 
session_start();
require('appClass/Autoloader.php');

$server = $_SERVER['SERVER_NAME'];

$json = file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/private/recaptcha.json");

$obj = json_decode($json);

$recaptDetails = new RecaptDetails();

switch ($server){
  case "localhost":
      $recaptDetails = $obj->dev;
    break;
  case "rfo-main-site-admin73522.codeanyapp.com":
      $recaptDetails = $obj->sit;
  break;
  case "www.royalflush.online":
      $recaptDetails = $obj->prod;
  break;
}


?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
	<head>
		<meta charset="UTF-8">
		<title></title>

		<link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
        crossorigin="anonymous">
   <link rel="stylesheet" href="css/theme.css">


  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
			    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
          integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
          crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>	
		

		<?php 
			function dobDay(){
			$dayList = '<div class="dropdown">
								<a class="btn btn-success dropdown-toggle" id="dayChoice" data-toggle="dropdown">
									Day
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" id="daysDropdown">';

					for($i = 1; $i<32; $i++){
							$dayList .= '<li><a tabindex="-1">'. $i . '</a></li>';
					}

					$dayList .= '</ul>
					</div>';

					return $dayList;
}

			function dobMonth(){
				$monthList = '<div class="dropdown">
							<a class="btn btn-success dropdown-toggle" id="monthChoice" data-toggle="dropdown">
								Month
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" id="monthDropdown">';

				for($i = 1; $i<13; $i++){
						$monthList .= '<li><a tabindex="-1">'. $i . '</a></li>';
				}

				$monthList .= '</ul>
				</div>';

				return $monthList;
			}

			function dobYear(){
				$yearList = '<div class="dropdown">
							<a class="btn btn-success dropdown-toggle" id="yearChoice" data-toggle="dropdown">
								Year
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" id="yearDropdown">';

				 date_default_timezone_set("UTC");
				$minAge =  date('Y') - 14;

				for($i = $minAge; $i >= date("Y")-100; $i--){ 
						$yearList .= '<li><a tabindex="-1">'. $i . '</a></li>';
				}

				$yearList .= '</ul>
				</div>';

				return $yearList;
			}
		?>
	</head>
 <body>
 
    <?php
//         include_once 'appClass/Member.php';
 
	 			$user = $firstName = $lastName = $email = $day = $month = $year
						= $dob = $pass = $passChk = $result = $disPic = $tempStr = "";
	 			
   			$errPsdChk = $errPsd = $errDOB = $errEm = $errLstNm = $errFstNm = $errUsrNm = $errDP = "";	 
	 
	 			$register = $usrChk = false;
	 
	 			$focus = "<script>$('#username input').focus();</script>";
	 
       if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            if(empty($_POST['user'])){
                $errUsrNm = '<h6 class="text-warning">Please Enter a username.</h6>';
								$register = false;
            } else {
				$member = new Member();
				$tempStr = $_POST['user'];
                $usrChk = $member->userCheck($tempStr);//future change to rest API
                
                if($usrChk){
                    $errUsrNm = '<h6 class="text-danger">Username already in use, please choose another.</h6>';
										$register = false;
                } else {
                    $user = $_POST['user'];
										$register = true;
                }
            }
        
            
            if(empty($_POST['email'])){
                	$errEm = '<h6 class="text-warning">Please Enter a email.</h6>';
					$register = false;
            	} else {
							
					$email = $_POST['email'];
               
					if(empty(filter_var($email, FILTER_VALIDATE_EMAIL))){
								
						$errEm = '<h6 class="text-warning">Please enter Valid email address eg: <i>youraddress@provider.com</i></h6>';
					} else {
                		$member = new Member();
						$emChk = $member->emailCheck($_POST['email']);//future change to rest API
								
                		if($emChk == true){
                    		$errEm = '<h6 class="text-danger">Email already in use, please choose another</h6>';
							$register = false;
						}	else {
								if($register){
									$register = true;
								}
							}
            		} 
				}
					
						if (empty($_POST['fstNm'])){
                $errFstNm = '<h6 class="text-warning">Please Enter a first name.</h6>';
								$register = false;
            } else {
							$tempStr = $_POST['fstNm'];
							$firstName = filter_var($tempStr, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
							
							$regx = "/[0-9\s]/";
							if(preg_match($regx, $firstName)){
								$errFstNm = '<h6 class="text-warning">Please only use letters.</h6>';
								$register = false;
							} else {
								if($register){
											$register = true;
										}
							}
						}
					
						if (empty($_POST['lstNm'])){
                $errLstNm = '<h6 class="text-warning">Please Enter a last name.</h6>';
								$register = false;
            } else {
							$tempStr = $_POST['lstNm'];
							$lastName = filter_var($tempStr, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
							
							$regx = "/[0-9\s]/";
							if(preg_match($regx, $lastName)){
								$errFstNm = '<h6 class="text-warning">Please only use letters.</h6>';
								$register = false;
							} else {
								if($register){
											$register = true;
										}
							}
						}
					
						if (empty($_POST['dayVal']) or empty($_POST['monthVal']) or empty($_POST['yearVal'])){
                $errDOB = '<h6 class="text-warning">Please Enter a date of birth.</h6>';
								$register = false;
            } else {
							$day = $_POST['dayVal'];
							$month = $_POST['monthVal'];
							$year = $_POST['yearVal'];
							
							$member = new Member();
							$tempStr = $member->validateDob($day, $month, $year);
							
							switch ($tempStr){
									
								case '30MtD':
									$errDOB = '<h6 class="text-warning">Please enter a valid day for 
																is month</h6>';
									$register = false;
									break;
								case 'lpYr':
									$errDOB = '<h6 class="text-warning">Please enter a valid leap year</h6>';
									$register = false;
									break;
								case 'lpYrD':
									$errDOB = '<h6 class="text-warning">Please enter a valid day for
																a leap year</h6>';
									$register = false;
									break;
								case 'true':
									//$dob = $day . '/' . $month . '/' . $year;
									$dob = $year . '-' . $month . '-' . $day;
									if($register){
											$register = true;
										}
									break;
							}	
							
							
						}
					
						if(empty($_POST['pass'])){
							$errPsd = '<h6 class="text-warning">Please enter a password<h6/>';
							$register = false;
						}  else {
							$pass =  $_POST['pass'];
							$regx = "/(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/";
							if(!preg_match($regx, $pass)){
									$errPsd = '<h6 class="text-warning">Password Needs to contain minimum 8<br/> characters, one of which needs to be uppercase and one number.</h6>';
									$register = false;
								} else if($pass === $_POST['passChk']){
									
									$member = new Member();
									$hashPass = $member->passEncrypt($pass);
									if($register){
											$register = true;
										}
								} else {
								$errPsdChk = '<h6 class="text-danger">Passwords need to match!!<h6/>';
								$register = false;
							}
						}
					
					if(!empty($_POST['disPic'])){
			
						$targetDir = 'images/usrDP/';
						$imgExt = pathinfo($targetFile, PATHINFO_EXTENSION);
						$targetFile = $targetDir . $user . $imgExt;


						$check = getimagesize($_FILES['disPic']['tmp_name']);
							if($check){
								//move_uploaded_file($_FILES['disPic']['tmp_name'], $targetFile);
								//$disPic =  $_FILES['disPic']['name'];
								$disPic = $targetFile;

							} else {
											$errDP = '<h6 class="text-warning">Error in uploading picture, please try again. 
											<br/>If this persists please register with out and contact support.</h6>';

								$disPic = null;
							}
									
						} else {
							$disPic= null;
						} 
					
						if($register){
							
							$memberAdd = new member($firstName, $lastName, $dob, $email,  $user, $hashPass, $disPic);
							
							$member = new Member();
							
							try{
								$member->registerUser($memberAdd);
							}
							catch (Exception $e){
                $message = new Message("Ah Smeg, this has gone a bit roung and sadly you will need to do re-enter you details again. If this happens again please contact us at admin@royalflush.online to report this possible gremlin.", "warning");
       
								header('Location: index.php', true);
							}
							
							if($disPic !== null){	
								move_uploaded_file($_FILES['disPic']['tmp_name'], $targetFile);
							}
							
							$json = $member->sendAct($email);
              
              $res = json_decode($json);
							
							if($res->status){
                
                $message = new Message("You details has been logged in our system, Yay!! To complete the process please check you email and activate your account. ***Please note that at present our emails are getting stuck in peoples junk mail so, double check there.***", "success");
								header('Location: index.php', true);
							
							} else {
                $message = new Message('Oh dear, I believe in computer jargen something has gone tits up. You details have been saved but you activation email has been stuck down in its prime, please try and log in to trigger another. If this presists please contact admin@royalflush.online for assistance.', 'warning');
								header('Location: index.php', true);
								
							}
							
							
						}
						
					 }	
				
        
    ?>
    
      <nav id="menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<!--<a class="navbar-brand" href="."><span class="icon-royalflushHomeIcon"></span></a>-->
						<a class="navbar-brand" href=".">Royalflush</a>
					</div>
				</div>
      </nav>
    <section id="body" class="container">
      <h1>Registration</h1>
			<hr/>
      <p class="lead">Please enter the details you wish to store in our system. All details are kept securly on our system and never shared with anyone else other than my Gran, she loves a good gossip.</br/>Thanks for taking the time to join our little gang and hope to continue to hear more from you.</p> <h5> All fields market with an astrix(*) next to their lable are manditory information.</h5>
	
	 <br/>
	 <br/>
	 
      <div class="row" onload="setUp()">
        
        <form class="form-horizontal" method="post" action="register.php" enctype="multipart/form-data">
          
          <div class="form-group" id="username">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="user">*Username: </label>
            <div class="col-md-4 col-sm-4">
              <input type="text" name="user" class="form-control" placeholder="Username" value="<?php echo $user; ?>">
            </div>
            <label class="control-lable"><?php echo $errUsrNm; ?></label>
          </div>
					
					 <div class="form-group" id="password">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="pass">*Password:</label>
            <div class="col-md-4 col-sm-4" id="passDiv">
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
            </div>
            <label class="control-lable"><?php echo $errPsd; ?></label>
          </div>
          
          <div class="form-group" id="passwordConfirmation">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="passChk">*Confirm Password</label>
            <div class="col-md-4 col-sm-4" id="passChkDiv">
              <input type="password" name="passChk" id="passChk" class="form-control" placeholder="Confirm">
            </div >
            <label class="control-lable" id="errPsdChk" name="errPsdChk"><?php echo $errPsdChk; ?></label>
          </div>
          
          <div class="form-group" id="firstName">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="fstNm">*First Name:</label>
            <div class="col-md-4 col-sm-4">
              <input type="text" name="fstNm" class="form-control" placeholder="First Name" value="<?php echo $firstName; ?>">
            </div>
            <label class="control-lable"><?php echo $errFstNm; ?></label>
          </div>
          
          <div class="form-group" id="lastName">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="lstNm">*Last Name</label>
            <div class="col-md-4 col-sm-4">
              <input type="text" name="lstNm" class="form-control" placeholder="Last Name" value="<?php echo $lastName; ?>">
            </div>
            <label class="control-lable"><?php echo $errLstNm; ?></label>
          </div>
          
          <div class="form-group" id="Email">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="email">*Email</label>
            <div class="col-md-4 col-sm-4">
              <input type="text" name="email" class="form-control" placeholder="Valid Email" value="<?php echo $email; ?>">
            </div>
            <label class="control-lable"><?php echo $errEm; ?></label>
          </div>
					
					<div class="form-group" id="disPic">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="disPic">Display Picture</label>
            <div class="col-md-4 col-sm-4">
              <input type="file" name="disPic" id="disPic" class="form-control-file">
            </div>
            <label class="control-lable"><?php echo $errDP; ?></label>
          </div>

					<div class="form-group" id="DateofBirth">
						<label class="control-lable col-md-2 col-md-offset-2 col-sm-2"> *Date of Birth</label>
						<div class="col-md-4 col-sm-4">
							<div class="col-md-4 col-sm-4">
								<?php echo dobDay()?>
								<input type="hidden" name="dayVal" id="dayVal" class="form-control">
							</div>
							<div class="col-md-4 col-sm-4">
								<?php echo dobMonth()?>
								<input type="hidden" name="monthVal" id="monthVal" class="form-control">
							</div>
							<div class="col-md-4 col-sm-4">
								<?php echo dobYear()?>
								<input type="hidden" name="yearVal" id="yearVal" class="form-control">
							</div>
						</div>
						<label class="control-lable"><?php echo $errDOB; ?></label>
			</div>
          
          <!-- <div class="form-group" id="DateofBirth">
						<label class="control-lable col-md-2 col-md-offset-2 col-sm-2"> *Date of Birth</label>
						<div class="col-md-4 col-sm-4">
							<div class="btn-group btn-group-md">
								<?php //echo dobDay()?>
								<input type="hidden" name="dayVal" id="dayVal" class="form-control">
							</div>
							<div class="btn-group btn-group-md">
								<?php //echo dobMonth()?>
								<input type="hidden" name="monthVal" id="monthVal" class="form-control">
							</div>
							<div class="btn-group btn-group-md">
								<?php //echo dobYear()?>
								<input type="hidden" name="yearVal" id="yearVal" class="form-control">
							</div>
						</div>
						<label class="control-lable"><?php echo $errDOB; ?></label>
			</div> -->
          <div class="form-group" id="iRobot">
						<div class="col-md-10 col-md-offset-4">
							<div class="g-recaptcha" data-sitekey="<?php echo $recaptDetails->siteKey; ?>"
										data-theme="dark" data-callback="iRobot"></div>
							<label id="test"></label>
						</div>
					</div>
          <div class="form-group" id="submitButtonFrmGrp">
            <div class="col-md-10 col-md-offset-4">
              <input type="submit" class="btn btn-success" value="Submit" 
							name="submitButton" id="submitButton">
            </div>
          </div>  
          
        </form>
      <br/>
      <h3>Issues contact</h3>
      <div>
        <address>
          <strong>Support:</strong> <a href="mailto:support@royalflush.online">Support@royalflush.online</a>
        </address>
      </div>
    </section>
    <footer class="container">
		<p>&COPY; <?php echo date('Y'); ?> Royalflush </p>
    </footer>
  </div>
	 
	<script src="js/register.js"></script>		 
	<script src="js/recaptcha.js"></script>
	 
  </body>
</html>