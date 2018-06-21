<?php 

// spl_autoload_register(function ($className) {

//     if(strcmp($className, 'DataAccess') !== 0){
//         include dirname(__FILE__).DIRECTORY_SEPARATOR. $className . '.php';
//     } else {
//         include 'appData' . DIRECTORY_SEPARATOR. $className . '.php';
//     }
    
// });

spl_autoload_register(function ($className) {
  
  
    
    include dirname(__FILE__).DIRECTORY_SEPARATOR. $className . '.php';

    
    
    
    
});

?>