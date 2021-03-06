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

		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/theme.css">
      
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		

		<?php 
			function dobDay(){
			$dayList = '<div class="dropdown">
								<button class="btn btn-success" id="dayChoice" data-toggle="dropdown">
									Day
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" id="daysDropdown">';

					for($i = 1; $i<32; $i++){
							$dayList .= '<li><a href="#" tabindex="-1">'. $i . '</a></li>';
					}

					$dayList .= '</ul>
					</div>';

					return $dayList;
}

			function dobMonth(){
				$monthList = '<div class="dropdown">
							<button class="btn btn-success" id="monthChoice" data-toggle="dropdown">
								Month
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" id="monthDropdown">';

				for($i = 1; $i<13; $i++){
						$monthList .= '<li><a href="#" tabindex="-1">'. $i . '</a></li>';
				}

				$monthList .= '</ul>
				</div>';

				return $monthList;
			}

			function dobYear(){
				$yearList = '<div class="dropdown">
							<button class="btn btn-success" id="yearChoice" data-toggle="dropdown">
								Year
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" id="yearDropdown">';

				 date_default_timezone_set("UTC");
				$minAge =  date('Y') - 14;

				for($i = $minAge; $i >= date("Y")-100; $i--){ 
						$yearList .= '<li><a href="#" tabindex="-1">'. $i . '</a></li>';
				}

				$yearList .= '</ul>
				</div>';

				return $yearList;
			}
		?>
	</head>
 <body>
 
    <?php
        include_once 'appClass/Member.php';
 
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
                $usrChk = $member->userCheck($tempStr);
                
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
						$emChk = $member->emailCheck($_POST['email']);
								
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
								header('Location: index.php?type=warning&msg=Ah Smeg, this has gone a bit roung and sadly you will need to do re-enter you details again. If this happens again please contact us at admin@royalflush.online to report this possible gremlin.', true);
							}
							
							if($disPic !== null){	
								move_uploaded_file($_FILES['disPic']['tmp_name'], $targetFile);
							}
							
							$res = $member->sendAct($email);
							
							if($res['status']){
								header('Location: index.php?type=success&msg=You details has been logged in our system, Yay!! To complete the process please check you email and activate your account. ***Please note that at present our emails are getting suck in peoples junk mail so, double check there.***', true);
								
							} else {
								header('Location: index.php?type=warning&msg=Oh dear, I believe in computer jargen something has gone tits up. You details have been saved but you activation email has been stuck down in its prime, please try and log in to trigger another. If this presists please contact admin@royalflush.online for assistance.', true);
								
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
      <p class="lead">Please enter the details you wish to store in our system. All details are kept securly on our system and never shared with anyone else other than my Gran, she loves a good gossip.</br/>Thanks for taking the time to join our little gang and hope to continue to hear more from you</p> <h5> All fields market with an astrix(*) next to their lable are manditory information.</h5>
	
	 <br/>
	 <br/>
	 
      <div class="row">
        
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          
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
					<div class="btn-group btn-group-md">
						<?php echo dobDay()?>
            <input type="hidden" name="dayVal" id="dayVal" class="form-control">
					</div>
					<div class="btn-group btn-group-md">
						<?php echo dobMonth()?>
            <input type="hidden" name="monthVal" id="monthVal" class="form-control">
					</div>
          <div class="btn-group btn-group-md">
						<?php echo dobYear()?>
            <input type="hidden" name="yearVal" id="yearVal" class="form-control">
					</div>
				</div>
						<label class="control-lable"><?php echo $errDOB; ?></label>
			</div>
          
          <div class="form-group" id="submitButton">
            <div class="col-md-10 col-md-offset-4">
              <input type="submit" class="btn btn-success" value="Submit" >
            </div>
          </div>  
          
        </form>
      <br/>
      <h3>Issues contact</h3>
      <div>
        <address>
          <strong>Support:</strong> <a href="mailto:Support@fakelebowskifansite.com">Support@royalflush.online</a>
        </address>
      </div>
    </section>
    <footer class="container">
      <p>&COPY; 2016 Royalflush </p>
    </footer>
  </div>
	 
	<script src="js/register.js"></script>		 
	 
  </body>
</html>