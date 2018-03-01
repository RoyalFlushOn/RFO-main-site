<?php

$ra1 = $ra2 = $ra3 = new Article();
$log = new Logger();
$log->startLog();


if($_SESSION['topArticles'] != null){

    // $artCol = new Collection();
    $log->logEntry('session is not null, collection being retrived');
$artCol = $_SESSION['topArticles'];
    $log->logEntry('Collection passed to artCol');

} else {
    $log->logEntry('Session is null');
$art = new Article();

$artCol = $art->topThreeArticles();
$log->logEntry('Top three articles retrieved and set to artcol');

$_SESSION['topArticles'] = $artCol;

$log->logEntry('Session is set to collection of Article objects.');
}
// print_r($artCol);

// $ra1 = $artCol->getItem("RA1");
//     $log->logEntry('Article ' . $ra1->getId().  ' retrived');
// $ra2 = $artCol->getItem("RA2");
//     $log->logEntry('Article ' . $ra2->getId().  ' retrived');
// $ra3 = $artCol->getItem("RA3");
//     $log->logEntry('Article ' . $ra3->getId().  ' retrived');

$ra1 = $artCol["RA1"];
    $log->logEntry('Article ' . $ra1['article_id'] . ' retrived');
$ra2 = $artCol["RA2"];
    $log->logEntry('Article ' . $ra2['article_id'] . ' retrived');
$ra3 = $artCol["RA3"]; 
    $log->logEntry('Article ' . $ra3['article_id'] .  ' retrived');

    $log->endLog();

?>