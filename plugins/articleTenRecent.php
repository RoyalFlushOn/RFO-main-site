<?php

$article = new Article();
$articleCollection = $article->getTenMostRecentArticles();

$articleList = '';

if($articleCollection != false){
  foreach($articleCollection as $art){
      $articleList .= '<div class="media">
                          <div class="media-left">
                            <a href="articleDisplay.php?id=' . $art['article_id'] .'">
                              <img src="'. $art['thumbnail'] .'" alt="" class="media-object" style="height:64px; width:64px;">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading">'. $art['headline'] .'</h4>
                            '. $art['tagline'] .'<hr/>
                          </div>
                        </div>';
    }
} else {
  $articleList .= 'error hmmm?';
}



echo $articleList;

?>