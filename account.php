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
 	<?php //include('plugins/CommentsPlugin.php');
// 				include('plugins/UserStatusPlugin.php');
	
// 				$login = pageload();
// 				$regStat = '';
	
// 			if($login['login']){
// 				if($login['regStat']){
// 					$loginStat = '<script>$("#login a").hide(); 
// 					$("#reg a").hide();</script>';	
// 				} else {
// 					$loginStat = '<script>$("#logout a").hide();</script>';
// 					$regStat = '<div class="alert alert-warning fade in">
// 				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
// 				<strong>Notice</strong> This account is registered but not activated. Please check email or click on this link, <a href="activation.php">Activate</a>
// 			</div>';
// 				}
// 			} else {
// 				$loginStat = '<script>$("#logout a").hide();
// 				$("#login a").show();
// 				$("#reg a").show();</script>';
// 			}
	
// 	$page = $_SERVER['PHP_SELF'];
	
// 	echo $regStat;
	
// 	if(isset($_GET['msg'])){
// 		$msg = htmlspecialchars($_GET['msg']);
// 		$type = htmlspecialchars($_GET['type']);
		
// 		echo  '<div class="alert alert-' . $type .  ' fade-out">
// 				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
// 				<strong>Notice</strong> ' . $msg .'
// 			</div>';
		
// 	}
	
	?>
  
	
</head>
  
  <body>
    <div class="container">
			
			<div class="col-md-6 col-lg-4">
				<img class="img-resposive" src="images/usrDP/UserNewTest.png" alt="display pic">
			</div>
				<div class="col-md-6 col-lg-4">
					
					<div class="row">
						<div class="col-md-6 col-lg-4">
							<h4>
								Name:
							</h4>
						</div>
						<div class="col-md-6 col-lg-4">
							-database:first+second-
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-6 col-lg-4">
								<h4>
									Email:
							</h4>
						</div>
						<div class="col-md-6 col-lg-4">
							-database:email-
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6 col-lg-4">
							<h4>
								Member Since:
							</h4>
						</div>
						<div class="col-md-6 col-lg-4">
							calculated(-dtatbase:creation- minus today)
						</div>
					</div>
					
				</div>
			</div>
			<hr/>
			<div class="container">
				<div class="col-md-6 col-lg-6">
					
					<div class="panel-group" id="accordian">
						<div class="panel panel-default">
							<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#passSect" data-parent="#accordian" id="passPnlCol" >
									Password Change
								</a>
								</h4>
							</div>
							<div class="panel-collapse collapse" id="passSect">
								
								<div class="panel-body">
									<form class="form-horizontal" id="passForm" role="form">
										<div class="form-group" id="passOld">
											<label class="control-label col-md-4 col-lg-4" for="passOld">Old Password</label>
											<div class="col-md-7 col-lg-7">
												<input class="form-control" id="OldTxtBx" type="password">
											</div>
											<label class="control-label col-offset-md-5 col-lg-offset-5" id="errOldPass"></label>
										</div>
										<div class="form-group">
											<label class="control-label col-md-4 col-lg-4" for="passNew">New Password</label>
											<div class="col-md-7 col-lg-7">
												<input class="form-control" id="passNew" type="password">
											</div>
										</div>
										<div class="form-group" id="passConf">
											<label class="control-label col-md-4 col-lg-4" for="passConf">Confirm Password</label>
											<div class="col-md-7 col-lg-7">
												<input class="form-control" id="pCTxtBx" type="password">
											</div>
										</div>
										<label class="control-lable col-md-offset-5 col-lg-offset-5" id="errPsdConf" name="errPsdConf"></label>
									</form>
									</div>

							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" href="#dttSect" data-parent="#accordian" >
									Edit Details
								</a>
								</h4>
							</div>
							<div class="panel-collapse collapse" id="dttSect">
								
							<div class="panel-body">
								form in here
								</div>

							</div>
						</div>
					</div>

				</div>
				<p id="resTest">
					Results Test
				</p>
				<br/>
				<p id="txt">
					content
				</p>
			</div>
  </body>
	
	<script src="js/site.js"></script>
  
</html>