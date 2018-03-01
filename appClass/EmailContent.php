<?php 

class EmailContent {
  
  private $temp = 'body{
margin:70px;
}';
  
  function __construct(){
    //generic constructor
  }
  
  function getTemp(){
    
    return $this->temp;
  }
}
?>