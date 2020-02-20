<?php session_start();


?>
      <div class="container">
        <!-- sets up the menu toggle when page is viewed on a small screen id mobile. -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navOptions">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                  </button>
          <a class="navbar-brand" href=".">Royalflush</a>
          <!-- adds the home logo link to bar -->
        </div>
        <!-- adds the navigation links -->
        <div class="collapse navbar-collapse" id="navOptions">
          <ul class="nav navbar-nav">
            <li><a href="about.php">About</a></li>
            <li><a href="contactUs.php">Contact Us</a></li>
            <?php 
                
                if(isset($_SESSION['user'])){
                    $user = json_decode($_SESSION['user']);

                    if($user->level == 99){
                        echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="dropDev"> 
                                  Features
                                  <span class="caret"></span>
                                </a>
                        <ul class="dropdown-menu" id="devList">
                          <li><a href="articleEditing.php">Article Editing</a></li>
                        </ul>
                      </li>';
                    }
                }
                
            ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li id="reg" class="disabled"><a href="register.php"
                  data-toggle="tooltip" 
                  data-placement="bottom" 
                  title="Register(Under Review)"><span class="glyphicon glyphicon-user"></span></a></li>
            <li id="login"><a href="loginPage.php" 
                  data-toggle="tooltip" 
                  data-placement="bottom" 
                  title="Log In">
                <span class="glyphicon glyphicon-log-in"></span></a></li>
            <li id="logout"><a
                  class="btn"
                  data-toggle="tooltip" 
                  data-placement="bottom" 
                  title="Log Out"
                  onclick="logout()">
                <span class="glyphicon glyphicon-log-out"></span></a></li>
            
          </ul>
        </div>

      </div>
  </nav>
<?php 

//  if(isset($_SESSION['message'])){
//     $message = json_decode($_SESSION['message']);
    
//     if($message->type != null){
//       if($message->content != null){

//         echo  '<div class="alert alert-' . $message->type .  ' fade-out">
// 				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//         <strong>Notice</strong> ' . $message->content .'
//         </div>';
//       } else {
//         echo 'hmmm';
//       }
//     } else {
//       //record in the log error with messages
//       echo 'thats not right';
//     }
//     unset($_SESSION['message']);
		
//   }

?>
  