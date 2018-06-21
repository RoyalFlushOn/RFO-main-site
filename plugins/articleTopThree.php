<?php

//$ra1 = $ra2 = $ra3 = new Article();
// $log = new Logger();
// $log->startLog();


if(!isset($_SESSION['topArticles'])){

    // $artCol = new Collection();
    // $log->logEntry('session is not null, collection being retrived');
    $artCol = $_SESSION['topArticles'];
    // $log->logEntry('Collection passed to artCol');

} else {
  
  $art = new Article();
  
  //print_r($art);
  
  $artCol = $art->topThreeArticles();
  
  $_SESSION['topArticles'] = $artCol;
  
//     // $log->logEntry('Session is null');
//   $art = new Article();

//   $artCol = $art->topThreeArticles();
// // $log->logEntry('Top three articles retrieved and set to artcol');
  
//   if($artCol){
//     $artCol["RA1"] = defaultDisplayContent();
//     $artCol["RA2"] = defaultDisplayContent();
//     $artCol["RA3"] = defaultDisplayContent();
//   } else {
    
//     switch(count($artCol)){
//       case 1:
//         $artCol["RA2"] = defaultDisplayContent();
//         $artCol['RA3'] = defaultDisplayContent();
//         break;
//       case 2:
//         $artCol['RA3'] = defaultDisplayContent();
//     }
    
//     $_SESSION['topArticles'] = $artCol;
    
  }



// $log->logEntry('Session is set to collection of Article objects.');
// }
// print_r($artCol);

// $ra1 = $artCol->getItem("RA1");
//     $log->logEntry('Article ' . $ra1->getId().  ' retrived');
// $ra2 = $artCol->getItem("RA2");
//     $log->logEntry('Article ' . $ra2->getId().  ' retrived');
// $ra3 = $artCol->getItem("RA3");
//     $log->logEntry('Article ' . $ra3->getId().  ' retrived');

  $ra1 = $artCol["RA1"];
  $ra2 = $artCol["RA2"];
  $ra3 = $artCol["RA3"]; 

    // $log->logEntry('Article ' . $ra1['article_id'] . ' retrived');

    // $log->logEntry('Article ' . $ra2['article_id'] . ' retrived');

    // $log->logEntry('Article ' . $ra3['article_id'] .  ' retrived');

    // $log->endLog();


?>