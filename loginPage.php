<?php 
session_start(); 
require('appClass/Autoloader.php');
require('plugins/SetupPage.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Royalflush</title>
  
  
<!--   <link rel="stylesheet" 
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
        crossorigin="anonymous">
  
  <link rel="stylesheet" href="css/theme.css">
  
  <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
          integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
          crossorigin="anonymous"></script>  -->
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/theme.css">
  
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  
  <?php 
    $userNm = $errUser = $errPass = $txtBxUsr = $sucess = $page = $unverfied = "";
	
		$focus = "<script>$('#username input').focus();</script>";
  
    // if(isset($_GET['page'])){ 
    //   $_SESSION['login_location'] = $_GET['page'];
    // } else {
    //   if(!isset($_SESSION['login_location'])){
    //     $_SESSION['login_location'] = htmlspecialchars($_SERVER['PHP_SELF']);
    //   }
      
    // }
  
    if(isset($_SESSION['user'])){

      $user = json_decode($_SESSION['user']);

      if($user->status === 'verified'){
        $message = new Message('You are already logged in!', 'info');
        $message->addMessageToSession();
        header('Location: index.php'); //<-- production link
      } else {
        $unverfied = '<div class="alert alert-warning fade-out">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Notice</strong>This account has not been verified yet. Please verify via emailed link. If this link has timed out then please click <a href="activation.php?trigger=yes&email='. $_SESSION['user']['email'] . '">here</a>
			</div>';
      }
      
    }
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                
        $userNm = $errUser = $errPass = "";
        
        if(empty($_POST["username"])){
          $errUser = '<p class="text-warning">Please enter a user name.</p>';
        } else {
          $userNm = $_POST["username"];
          
          if(empty($_POST["password"])){
            $errPass = '<p class="text-warning">Please enter a password.</p>';
            $txtBxUsr = $userNm;
          } else {
            $member = new Member();
            
            if($member->userCheck($userNm)){
              if($member->passCheck($_POST['password'], $userNm)){
                
                $temp = $member->getUserData($userNm);
                
                foreach($temp as $item){
                  
                  $user->fName = $item['first'];
                  $user->lName = $item['second'];
                  $user->DOB = $item['D_O_B'];
                  $user->email = $item['email'];
                  $user->user = $item['username'];
                  $user->cDate = $item['creation'];
                  $user->status = $item['status'];
                  $user->level = $item['level'];
                  $user->dPic = $item['dis_pic'];
                }

                if($user->status != 'verified'){
                  $unverfied = '<div class="alert alert-warning fade-out">
			                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				                      <strong>Notice</strong>This account has not been verified yet. Please verify via emailed link. If this link has timed out then please click <a href="activation.php?trigger=yes&email='. $user->email . '">here</a>
		                    	    </div>';
                } else {
                  $_SESSION['user'] = json_encode($user);
                
                  $page = $_SESSION['login_location'];
                  unset($_SESSION['login_location']);

                  $message = new Message('You are now logged in, Yay!', 'info');
                  $message->addMessageToSession();
                  header('Location:' . $page);
                }
              } else {
                $errPass = '<span class="text-danger">Password not recognised</span>';
                $txtBxUsr = $userNm;
								$focus = '<script>$("#password input").focus();</script>';
              }
            }else{
              $errUser = '<p class="text-danger">Username not known either retry or register</p>';
            }
          }
        }
      }
  ?>
  
</head>

<body>
  <div id="page">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar" name="navbar">
    </nav>
    <section id="body" class="container">
      <h1>Login page</h1>
      <p>Please enter your registered Username and Password</p>
      
      <br/>
      <?php echo $unverfied ?>
      
      <div class="row">
        <form class="form-horizontal" method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          
          <div class="form-group" id="username">
            <label for="username" class="control-label col-md-2 col-sm-2 col-md-offset-2">Username</label>
            <div class="col-md-4 col-sm-4">
               <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo $userNm; ?>" />
            </div>
            <label class="control-label"><?php echo $errUser; ?> </label >
          </div>
          
          <div class="form-group" id="password">
            <label for="password" class="control-label col-md-2 col-sm-2 col-md-offset-2">Password</label>
            <div class="col-md-4 col-sm-4">
              <input type="password" name="password" class="form-control" placeholder="password" />
            </div>
            <label class="control-lable"><?php echo $errPass; ?></label>
          </div>
          
          <div class="form-group">
            <div class="col-md-10 col-md-offset-4">
              <input type="submit" value="Login" class="btn btn-success" /> 
							<a href="forgotPassword.php?em=yes" class="btn btn-success ">Forgot Password</a>
            </div>
            
          </div>
          
        </form>
      </div>
			<?php echo $focus; ?>
      <h3>Issues contact</h3>
      <div>
        <address>
          <strong>Support:</strong> <a href="mailto:support@royalflush.online">support@royalflush.online</a>
        </address>
      </div>
    </section>
    <hr />
    <footer class="container">
      <p>&COPY; <?php echo date('Y'); ?> Royalflush </p>
    </footer>
  </div>
</body>
<script src="js/navbar.js"></script>
</html>
