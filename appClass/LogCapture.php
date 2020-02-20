<?php 
session_start();
require('Autoloader.php');

class LogCapture{
  
  private $log;
  private $file;
  private $logFile;
  
  function __constructor(){
    $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/private/paths.json');
		$paths = json_decode($json);
    $obj = $paths->logs;
    
    $logPath = $paths->logs ."/". date('Ymd'). session_id() ."-log.txt";
    
    $log = json_decode($_SESSION['log']);
    
    $logFile = 
  }
}
?>