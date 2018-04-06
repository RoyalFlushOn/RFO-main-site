<?php session_start(); ?>
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
    $userNm = $errUser = $errPass = $txtBxUsr = $sucess = $page = $unverfied = "";
	
		$focus = "<script>$('#username input').focus();</script>";
  
    
	
		require 'appClass/Member.php';
  
    if(isset($_GET['page'])){ 
      $_SESSION['login_location'] = $_GET['page'];
    } else {
      if(!isset($_SESSION['login_location'])){
        $_SESSION['login_location'] = $_SERVER['PHP_SELF'];
      }
      
    }
  
    if(isset($_SESSION['user'])){
      if($_SESSION['user']['status'] === 'verified'){
        header('Location: /index.php?msg=You are already logged in!&type=info'); //<-- production link
				//header('Location: /index-test.php?msg=You are already logged in!&type=info');
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
        }else{
          $userNm = $_POST["username"];
          
          if(empty($_POST["password"])){
            $errPass = '<p class="text-warning">Please enter a password.</p>';
            $txtBxUsr = $userNm;
          }else{
            $member = new Member();
            
            if($member->userCheck($userNm)){
              if($member->passCheck($_POST['password'], $userNm)){
                //$sucess = '<p class="text-success">it worked yay</p>';
                
                $temp = $member->getUserData($userNm);
                
								// foreach($temp as $item){
                      
                //     	$login['fName'] = $item['first'];
                //       $login['lName'] = $item['second'];
                //       $login['DOB'] = $item['D_O_B'];
                //       $login['email'] = $item['email'];
                //       $login['user'] = $item['username'];
                //       $login['cDate'] = $item['creation'];
                //       $login['status'] = $item['status'];
                //       $login['level'] = $item['level'];
                //       $login['dPic'] = $item['dis_pic'];
                // }

                $jsonUser = '{';
                foreach($temp as $item){
                  
                  $jsonUser += '"fName" : "' . $item['first'] . '",' .
                  '"lName" : "' . $item['second'] . '",' .
                  '"DOB" : "' . $item['D_O_B'] . '",' .
                  '"email" : "' . $item['email'] . '",' .
                  '"user" : "' . $item['username'] . '",' .
                  '"cDate" : "' . $item['creation'] . '",' .
                  '"status" : "' . $item['status'] . '",' .
                  '"level" : "' . $item['level'] . '",' .
                  '"dPic" : "' . $item['dis_pic'] . '"'; 
                }
                
                $jsonUser += '}';

                $user = json_decode($jsonUser);

                if($user->status !== 'verified'){
                 $unverfied = '<div class="alert alert-warning fade-out">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Notice</strong>This account has not been verified yet. Please verify via emailed link. If this link has timed out then please click <a href="activation.php?trigger=yes&email='. $login['email'] . '">here</a>
			</div>';
                } else {
                  $_SESSION['user'] = json_encode($user);
                
                $page = $_SESSION['login_location'];
                $_SESSION['login_location'] = ' ';
                header('Location:' . $page);
                }
               }else{
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
    <header class="container">
      <div id="menu" class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
          <button class="btn btn-success navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="glyphicon glyphicon-chevron-down"></span>
          </button>
          <div id="logo">
            <a href='.'>
              <img class="image-responsive" src="" alt="royalflush logo">
            </a>
          </div>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="nav"><a href=".">Home</a>
            </li>
             <li class="nav"><a href="about.html">About</a>
            </li>
     <!--       <li class="nav active"><a href="contact.html">Contact</a>
            </li> -->
          </ul>
        </div>
      </div>
    </header>
    <section id="body" class="container">
      <h1>Login page</h1>
      <p>Please enter your registered Username and Password</p>
      
      <br/>
      <?php echo $unverfied ?>
      
      <div class="row">
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          
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
							<a href="forgotPassword.php?em=yes" class="btn-sm btn-success ">Forgot Password</a>
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
      <p>&COPY; 2016 Royalflush </p>
    </footer>
  </div>
</body>

</html>
