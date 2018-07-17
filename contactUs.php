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
		<title>Royalflush</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">


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
    
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>	

  
	
</head>

  <body>
	
	  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar" name="navbar">
			
	  </nav>
    
    <div class="container">
      <h1>Contact Us Page</h1>
      <p>Please enter fill form below in, to pass on your question, statement etc.</p>
      
      <br/>
      <div class="row">

        <form class="form-horizontal">

          <div class="form-group">
              <label class="control-label col-md-3" for="subject">Subject</label>
              <div class="col-md-6">
                  <input type="text" class="form-control" id="subject" name="subject" placeholder="Add subject here">
                  <label id="subjtErr" name="subjtErr" class="control-label text-warning small" ></label>
              </div>

          </div>
          <div class="form-group">
              <label class="control-label col-md-3" for="contDets">Contact Details</label>
              <div class="col-md-8">
                <?php
                   if(isset($_SESSION['user'])){

                      $temp = $_SESSION['user'];
                      $userDetails = json_decode($temp);

                     echo '<h4><label id="contDets" name="contDets" class="label label-default">' . $userDetails->email . '</label></h4>';

                    } else {
                       echo '<input type="text" class="form-control" id="contDets" name="contDets" placeholder="Add headline here">
                        <label id="cntDtsErrLbl" name="cntDtsErrLbl" class="control-label text-warning small" ></label>';
                    }
                ?>
              </div>

          </div>


          <div class="form-group">
              <label class="control-label col-md-3" for="msgTxtBx">Message</label>
              <div class="col-md-6">
                  <textarea class="form-control" id="msgTxtBx" placeholder="Content here please..."
                                  name="msgTxtBx" value=""></textarea>
                  <label  id="msgErr" name="msgErr" class="control label text-warning "></label>
              </div>

          </div>

          <div class="form-group" id="iRobot">
            <div class="col-md-10 col-md-offset-4" id="recaptchaDiv">
              <div class="g-recaptcha" data-sitekey="<?php echo $recaptDetails->siteKey; ?>"
                        data-theme="dark" data-callback="iRobot"></div>
            </div>
          </div>
          <div class="form-group" id="submitButton" hidden="true">
               <div class="col-md-10 col-md-offset-4">
                <input type="button" class="btn btn-success" value="Submit" 
                name="sbmtBtn" id="sbmtBtn" >
                 <label  id="submitErr" name="submitErr" class="control label text-warning "></label>
              </div>
            
          </div>

        </form>
      </div>
    </div>
  </body>
  
  <script src="js/navbar.js"></script>
  <script src="js/recaptcha.js"></script>
  <script src="js/contactUs.js"></script>
  
  
</html>