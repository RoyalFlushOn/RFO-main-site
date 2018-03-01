<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Royalflush</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!--         <link rel="stylesheet" href="css/bootstrap-theme-dark.css">  -->
       <link rel="stylesheet" href="css/theme.css">
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  <?php 
		require 'appClass/Member.php';
	
	session_start();
	
    $userNm = $errUser = $errPass = $errPsd = $txtBxUsr = $sucess = $page = $unverfied = $npsw =
			$ver = $vstr = $test = $errEm =  "";
	
		$focus = "<script>$('#password input').focus();</script>";
	
		if(!$_GET['npsw'] == null ){

			if($_GET['npsw'] == 'true'){
				
				$npsw = $_GET['npsw'];
				$ver = $_GET['ver'];
				$vstr = $_GET['vstr'];
				
				$_SESSION['forgotPassword'] = array( $npsw, $ver, $vstr);
			}
		}
	
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			if(isset($_POST['email'])){
				if(!empty($_POST['email'])){
					$mem = new Member();
					$eml = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
					
					if($mem->emailCheck($eml)){
							
						try{
							$mem->resetPass($eml);
							
							$page = " ";
							
							header("Location: index.php?msg=Rest email has been sent to the provided address, please check your email for the gate way to your redemption and as always for the time being get your junk mail for our trash talking selves. Any problems as always contact support@royalflush.online&type=info"); 
						}catch(Exception $ex){
							
							header("Location: index.php?msg=ahh our bad, please try again, if you see this message again please contact support@royalflush.online for assistance");
						}
						

					} else { 
						$_GET['em'] = "yes";
						$errEm = '<h5 class="text-warning">Hmmm doesnt seem quite match up with our records? Please try again, if presists please contact our support channel on support@royalflush.online</h5>';
					 }
				} else {
					$_GET['em'] = "yes";
					$errEm = '<h5 class="text-warning">Please enter Valid email address eg: <i>youraddress@provider.com</i></h5>';
				}
			}
			
			if(isset($_POST['pass'])){

				if(empty($_POST['pass'])){
								
								$errPsd = '<h6 class="text-warning">Please enter a password<h6/>';
								
							}  else {
								$pass =  $_POST['pass'];
								$regx = "/(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/";
								if(!preg_match($regx, $pass)){
										$errPsd = '<h6 class="text-warning">Password Needs to contain minimum 8<br/> characters, one of which needs to be uppercase and one number.</h6>';
										
									} else if($pass === $_POST['passChk']){

										$member = new Member();
										$hashPass = $member->passEncrypt($pass);
										$dtAcc = new DataAccess();

										try{

											$dtAcc->nonReturnQuery("UPDATE Users SET password = '" . $hashPass . "' WHERE email = '" . $_POST['ver'] . "'");
											
											session_unset($_SESSION['forgotPassword']);
											
												header("Location: index.php?msg=Password reset successful, you can now log in at you liesure. If you still getting you shall not pass then please contact support@royalflush.online.&type=success");
											
											
										}
										catch(exception $e){
											header("Location: index.php?msg=Ooops got it wrong again dad, there has been a site error. Please trythe forgot password link again, if this happens again please cotact support@royalflush.online&type=info");
										}
									} else {
									
									$errPsdChk = '<h5 class="text-danger">Passwords need to match!!<h5/>';
								}
							}
				}
			
			
		}
	
		if(isset($_GET['em'])){
			
			if($_GET['em'] == 'yes'){
					$page = '<p>Please enter your registered email.</p>

					<div class="row">
						<form class="form-horizontal" method="post" action="forgotPassword.php">

							<div class="form-group" id="newPass">
								<label for="email" class="control-label col-md-2 col-sm-2 col-md-offset-2">Email</label>
								<div class="col-md-4 col-sm-4">
									 <input type="text" name="email" class="form-control" placeholder="Registered Email" />
								</div>
							</div>
							<div class="col-md-offset-4 col-md-6">
								'. $errEm .'
							</div>

							<div class="form-group">
								<div class="col-md-10 col-md-offset-4">
									<input type="submit" value="Send Reset" class="btn btn-success" /> 
								</div>

							</div>

						</form>
					</div>'; 
			} else{
				header("Location: index.php?msg=Hmmm this is highly irregular captain, please contact star fleet(thats us) @ support@royalflush.online is this continues&type=warning");
			}
		} else if(isset($_SESSION['forgotPassword'])){
		
			if($_SESSION['forgotPassword'][0] == "true"){
				if(!empty($_SESSION['forgotPassword'][2])){
					$mem = new Member();
					if($mem->verifyFP($_SESSION['forgotPassword'][2], $_SESSION['forgotPassword'][1])){
						
						$eml = $_SESSION['forgotPassword'][1];
						
						$page = '  <p>Please enter your new password.</p>

						<div class="row">
							<form class="form-horizontal" method="post" action="forgotPassword.php">
							
							<div class="form-group" id="password">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="pass">New Password:</label>
            <div class="col-md-4 col-sm-4" id="passDiv">
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Min of 8 long, One capital one number">
            </div>
            <label class="control-lable">'. $errPsd . '</label>
          </div>
          
          <div class="form-group" id="passwordConfirmation">
            <label class="control-lable col-md-2 col-sm-2 col-md-offset-2" for="passChk">*Confirm Password</label>
            <div class="col-md-4 col-sm-4" id="passChkDiv">
              <input type="password" name="passChk" id="passChk" class="form-control" placeholder="Confirm new password">
            </div >
            <label class="control-lable" id="errPsdChk" name="errPsdChk"><?php echo $errPsdChk; ?></label>
          </div>
					
					<div class="form-group" id="email">
								<input class="form-control" type="hidden" name="ver" id="ver" value=' . $eml .'
								<div class="form-group">
									<div class="col-md-10 col-md-offset-4">
										<input type="submit" value="Reset Password" class="btn btn-success" /> 
									</div>

								</div>

							</form>
						</div>';
					} else{
				header("Location:index.php?msg=Hmmm this is highly irregular captain, please contact star fleet(thats us) @ support@royalflush.online is this continues&type=warning");
					}
				} else{
				header("Location:index.php?msg=Hmmm this is highly irregular captain, please contact star fleet(thats us) @ support@royalflush.online is this continues&type=warning");
				}
			} else{
				header("Location:index.php?msg=Hmmm this is highly irregular captain, please contact star fleet(thats us) @ support@royalflush.online if this continues&type=warning");
			}
		} else { 
			//echo "getter em is not set hmmm";
			header("Location:index.php?msg=Ooow sorry that is not allowed. Bye&type=info", ture);
		}
    
  ?>
  
</head>

<body>
  <div id="page">
    <header class="container">
      <div id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
          <div id="logo">
						<span class="icon-royalflushHomeIcon"></span>
          </div>
        </div>
      </div>
    </header>
    <section id="body" class="container">
      <h1>Forgotten Password</h1>
			<?php echo $page; ?>  
    
			<?php echo $focus; ?>
      <h3>Issues contact</h3>
      <div>
        <address>
          <strong>Support:</strong> <a href="mailto:support@royalflauh.online">Support@royalflush.online</a>
        </address>
      </div>
    </section>
    <hr />
    <footer class="container">
      <p>&COPY; <?php echo date('Y');?> Royalflush </p>
    </footer>
  </div>

	<script src="js/site.js"></script>
</body>

</html>
