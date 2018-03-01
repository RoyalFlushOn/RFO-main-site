<?php 

  require('appData/Feed.php');
  require('appClass/Collection.php');
  require('appClass/Tweet.php');

  class TwitterFeed{
    
    private $tweetCol;
    private $tweet;
    private $feed;
    private $rawTweets;
		private $start;
		private $content;
		private $finish;
    
    
    function __construct(){
      $a = func_get_args();
			$i = func_num_args();
			
			if(method_exists($this, $f='__construct'.$i)){
				call_user_func_array(array($this,$f), $a);
      }
    }
        
    function construct0(){
      //generic constructor
    }
      
    function getFeed(){
      
      $this->feed = new Feed();
      return $this->rawTweets = $this->feed->getOurTwitterFeed();
      if (isset($this->rawTweets[0]['id_str'])){
       // $this->rawTweets;
      } else {
       // return 'fail';
      }
    }
    
    //$id, $creation, $name, $screenName, $text, $dpURL, $retweet, $favorite,  $hashTags, $pics
    
    function returnFeed(){
      return $this->tweetCol;
    }
    
    function formatTweets(){
      $this->tweetCol = new Collection();
      
      foreach($this->rawTweets as $item){
                                
        $id = $item['id_str'];
        $creation = $item['created_at'];
        $name = $item['user']['name'];
        $screenName = $item['user']['screen_name'];
        $text = $item['text'];
        $dpURL = $item['user']['profile_image_url'];
        
        if ($item['retweet_count'] === 0 ){
            $retweet = 0;
          } else {
            $retweet = $item['retweet_count'];
          }
        
        if ($item['favorite_count'] === 0 ){
           $favorite = 0;
          } else {
           $favorite = $item['favorite_count'];
          }
        
         if(!empty($item['entities']['hashtags'][0])){
            $hashTags = true;
          } else {
            $hashTags = false;
          }
        
        if( array_key_exists('extended_entities', $item)){
        
          $arrLng = count($item['extended_entities']['media']);
        
          $pics = array();
        
          if ($arrLng !== 0){

            for ($i=0 ; $i < $arrLng; $i++){
              $pics[$i] = $item['extended_entities']['media'][$i]['media_url'];
            }

            } else {
              $pics[0] =  $item['extended_entities']['media'][0]['media_url'];
            }
          } else {
            $pis[0] = 'empty';
          }
				
				return $this->displayFeed($id, $creation, $name, $screenName, $text, $dpURL, 
                                 $retweet, $favorite,  $hashTags, $pics);
        
//           $this->tweet = new Tweet($id, $creation, $name, $screenName, $text, $dpURL, 
//                                  $retweet, $favorite,  $hashTags, $pics);
//           $this->tweet->formatText();
        
//           $this->tweetCol->addItem($this->tweet, null);
       }
      
     // return $this->tweetCol;
    }
    
   
// 		function displayFeed(){
			
// 			include('appAPI/emoji.php');
			
// 			$emoji = new emoji();
			
// 			$content = '<div class="default-media">
					
// 					<div class="panel panel-default"
// 							 style="height: 325px; overflow-x: hidden;">';
			
//  			foreach($this->rawTweets as $item){
				
// 				if(!empty($item['entities']['hashtags'][0])){
//             $hash =true;
//           } else {
//             $hash = false;
//           }
				
// 				$content .= '<div class="media">
// 						<div class="media-left">
// 							<img src="'. $item['user']['profile_image_url'] . '"
// 									 alt="display Pic"
// 									 class="media-object img-rounded"
// 									 style="width: 32px; height: 32px">
// 						</div>
// 						<div class="media-body">
// 							<h5 class="media-heading">';
// 								$item['user']['name'] . '<small>'. $item['user']['screen_name']
// 									.'</small></h5>' . $item['text'];

// 				if( array_key_exists('extended_entities', $item)){
//               $arrLng = count($items['extended_entities']['media']);

//             if ($arrLng !== 0){
// 							$content .=  '<br/>';
							
//               for ($i=0 ; $i < $arrLng; $i++){
//                 $content .= '<img src="'. $item['extended_entities']['media'][$i]['media_url']. '"
// 										 style="width: 30%; height: 30%;"
// 										 alt="<small>display Picture</small>">';
//               }
//             } else {
//               $content .= '<img src="'. $item['extended_entities']['media'][0]['media_url']. '"
// 										 style="width: 30%; height: 30%;"
// 										 alt="<small>display Picture</small>">';
//             }	
//          }
				
// 				$content .= '<div class="row">';
				
// 				if ($items['retweet_count'] === 0 ){
// 					$content .= '<div class="col-md-3 col-md-offset-3">
// 					<span class="glyphicon glyphicon-retweet"><small>0</small></div>';
// 				} else {
// 					$content .= '<div class="col-md-3"><span class="glyphicon glyphicon-heart"><small>'
// 						. $items['retweet_count']. '</small></div>';
// 				}
				
// 				if ($items['favorite_count'] === 0 ){
// 					$content .= '<div class="col-md-3 col-md-offset-3">
// 					<span class="glyphicon glyphicon-retweet"><small>0</small></div>';
// 				} else {
// 					$content .= '<div class="col-md-3"><span class="glyphicon glyphicon-heart"><small>'
// 						. $items['favorite_count']. '</small></div>';
// 				}
				
// 				$content .= '<div><br/>';
				
// 			}
				
// 				$content .= '				</div>
// 													</div>
// 												</div>';
// 				return $content;
// 		}
		
  }
?>