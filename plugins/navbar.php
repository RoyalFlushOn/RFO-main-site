<?php session_start();?>
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
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
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
            <li id="reg"><a href="Register.php"
                  data-toggle="tooltip" 
                  data-placement="bottom" 
                  title="Register"><span class="glyphicon glyphicon-user"></span></a></li>
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
  