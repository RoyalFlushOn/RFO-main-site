<?php

  //require_once('appData/DataAccess.php');


  class Member{
    
    private $firstName;
    private $lastName;
    private $email = '';
    private $dob;
    private $userName;
    private $password;
    
    private $chkPass;
    private $dtAcc; 
    
    
    
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
    
     function __construct1($a1){
      $this->email = $a1;
    }
    
     function __construct6($a1, $a2, $a3, $a4, $a5, $a6){
      $this->firstName = $a1;
      $this->lastName = $a2;
      $this->email = $a3;
      $this->dob = $a4;
      $this->userName = $a5;
      $this->password = $a6;
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
    
     //check a validates a password being entered into the system
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
    function registerUser(){
      
			$dtAcc = new DataAccess();
        return $dtAcc->updateMemTab($this);
    }
    
    //validates a date of birth by the user
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
		
		function getDob(){
      return $this->dob;
    }
    
    function setFirstName($firstName){
      $this->firstName = $firstName;
    }
    
    function setLastName($lastName){
      $this->lastName = $lastName;
    }
    
    function setEmail($email){
      $this->email = $email;
    }
    
    function setDob($dob){
      $this->dob = $dob;
    }
    
    function setUser($userIn){
      $this->userName = $userIn;
    }
  }

 ?>

  

