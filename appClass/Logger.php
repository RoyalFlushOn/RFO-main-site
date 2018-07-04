<?php 

class Logger{
  
  private $log;
  private $path = '/logs/';
  
  
  function __construct(){
    //generic constructor
  }
  
  function startLog(){

    $pageRaw = htmlspecialchars($_SERVER['PHP_SELF']);

    $page = str_replace(".php", ".txt",substr($pageRaw,strrpos($pageRaw, '/') + 1 ,strlen($pageRaw) - strrpos($pageRaw, '/') ));
    
    $logPath = $_SERVER['SERVER_NAME'] . $this->path ."log". date('Ymd'). "-" . $page;
    //   echo $logPath;
    if(file_exists($logPath)){
//         echo "fie exists";
      $this->log = fopen($logPath, "a");
      fwrite($this->log, "\n");
      //needs a new file flag for entry below as append creates a new line anyway or see
      //if you can open and new file will append instead of write.
    } else {
//         echo "create a new file";
      $this->log = fopen($logPath, "w");
    }

    //$this->logEntry('Log started');
  }
  
  function endLog(){
    fclose($this->log);
  }
  
  function logEntry($entry){
    
    fwrite($this->log, date('Y-m-d h:i:sa') . " - " . $entry. "\n");
  }
}

//   echo $pageRaw = $_SERVER['PHP_SELF'];

//   echo substr($pageRaw,strrpos($pageRaw, '/') + 1 ,strlen($pageRaw) - strrpos($pageRaw, '/') );





// $pageRaw = $_SERVER['PHP_SELF'];

//   $page = str_replace(".php", ".txt",substr($pageRaw,strrpos($pageRaw, '/') + 1 ,strlen($pageRaw) - strrpos($pageRaw, '/') ));
  
//     $logPath = "log". date('Ymd'). "-" . $page;

// //   echo $logPath;
//   if(file_exists($logPath)){
//     echo "fie exists";
    
//     $log = fopen($logPath, "a");
//   } else {
//     echo "create a new file";
//     $log = fopen($logPath, "w");
//   }

//   fclose($log);

?>
