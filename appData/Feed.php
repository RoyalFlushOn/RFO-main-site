<?php 
  require_once('appAPI/TwitterAPIExchange.php');
//   include('appCode/Collection.php');
  
  class Feed{
    
    private $settings = array(
            'oauth_access_token' => '36497880-p4ypjzOGqBUhfpDDkh45B8U6zgWkH4M1pfySKFqio',
            'oauth_access_token_secret' => 'ACwWc7rdT8Z5fqNEa8xRvtcQEPjy0mF5valGvCmMk4Cs1',
            'consumer_key' => 'WmGKw89MEBh9OLMt7sJi8hnpU',
            'consumer_secret' => 'aXeF51qnEnI9qDPY2pPa0TvB5RD1KhoYjm5LevFSXhQ85dzXBg'
          );
    private $urlSelf = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
    private $urlOther = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    private $requestMethod;
    private $getField;
    private $feed;
    private $twitterAPI;
    
    function __construct(){
      $a = func_get_args();
			$i = func_num_args();
			
			if(method_exists($this, $f='__construct'.$i)){
				call_user_func_array(array($this,$f), $a);
			}
    }
    
    function __construct0(){
      
    }
    
    function getOurTwitterFeed(){
      $this->requestMethod = 'GET';
      
      $twitter = new TwitterAPIExchange($this->settings);
      
//       $string = json_decode($twitter->buildOauth($this->urlSelf, $this->requestMethod)
//                ->performRequest(), $assoc = TRUE);
			$string = var_dump($twitter->buildOauth($this->urlSelf, $this->requestMethod)
               ->performRequest());
      
      return $string;
      
    }
  }



// echo '<pre>';
// echo print_r($string);
// echo '</pre>';
  
//   if (!empty($string)){
    
  

//     foreach ($string as $items){
//           echo "Time and Date of Tweet: ".$items['created_at']."<br />";
//           echo "Tweet: ". $items['text']."<br />";
//           echo "Tweeted by: ". $items['user']['name']."<br />";
//           echo "Screen name: ". $items['user']['screen_name']."<br />";


//           if( array_key_exists('extended_entities', $items)){
//               $arrLng = count($items['extended_entities']['media']);
//               echo 'array length: ' . $arrLng. '<br/>';

//             if ($arrLng !== 0){
//               for ($i=0 ; $i < $arrLng; $i++){
//                 echo 'imgae url: ' .  $items['extended_entities']['media'][$i]['media_url']. '<br/>';
//               }
//             } else {
//               echo 'imgae url: ' .  $items['extended_entities']['media'][0]['media_url']. '<br/>';
//             }
//           }



//           if ($items['favorite_count'] === 0 ){
//             echo 'Favs: 0 </br>';
//           } else {
//             echo 'Favs'. $items['favorite_count']. '</br>';
//           }

//           if ($items['retweet_count'] === 0 ){
//             echo 'retweets: 0 </br>';
//           } else {
//             echo 'retweets'. $items['retweet_count']. '</br>';
//           }
      
//           if(!empty($items['entities']['hashtags'][0])){
//             echo 'hashtags: present';
//           } else {
//             echo 'hashtags: not here.';
//           }

//           echo '<hr />';
//     }
//   } 
?>