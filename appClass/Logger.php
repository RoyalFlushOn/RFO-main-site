<?php 
session_start();
require('Autoloader.php');

class Logger{
  
  private $log;
  private $i;
  
  private const WARN = 'WARN';
  private const INFO = 'INFO';
  private const ERROR = 'ERROR';
  private const DEBUG = 'DEBUG';
  
  function __construct(){
    //generic constructor
  }
  
  function startLog(){
    
    if(isset($_SESSION['log'])){
      $log = json_decode($_SESSION['log']);  
      $i= count($log);
    } else {
      $log = array();
      $i = 0;
    }
  }
  
  function endLog(){
    $_SESSION['log'] = json_encode($log);
  }
  
  function logEntry($type, $entry, $page){
    
    $entry = new LogEnrty();
    
    $entry->type = $type;
    $entry->msg = $entry;
    $entry->dt = date('Y-m-d');
    $entry->page = $page;
    
    $i++;
    $log[$i] = $entry;
  }
}

function warn($text, $page){
  $this->logEntry($this->WARN,$text, $page);
}

function info($text, $page){
  $this->logEntry($this->INFO,$text, $page);
}


function debug($text, $page){
  $this->logEntry($this->DEBUG,$text, $page);
}

function error($text, $page){
  $this->logEntry($this->ERROR,$text, $page);
}

?>
