<?php 
  
  class Tweet{
    
    private $id;
    private $creation;
    private $name;
    private $screenName = '@';
    private $text;
    private $disPic;
    private $retweet;
    private $favorite;
    private $hashSet;
    private $pics = array();
    
    public function __construct($id, $creation, $name, $screenName, $text, $dpURL, $retweet, $favorite,  $hashTags, $pics){
      
      $this->id = $id;  
      $this->creation = $creation;
      $this->name = $name;
      $this->screenName .= $screenName;
      $this->text = $text;
      $this->disPic = $dpURL;
      $this->retweet = $retweet;
      $this->favorite = $favorite;
      $this->hashSet = $hashTags;
      $this->pics = $pics;
    }
		
// 		public function __construct($a1){
// 			$this->text = $a1;
// 		}
     
    public function formatText(){
			
				$temp = $this->formatLink($this->text);
				//$temp = $this->text;
			
      if($this->hashSet){
        $fin = $this->formatHash($temp);
				$this->text = $fin;
      } else {
				$this->text = $temp;
			}
			
			if(preg_match('/(RT)/', $this->text)){
				$this->text = '<span class="text-primary">' . substr($this->text, 0, 2) . 
					'</span> ' . substr($this->text, 3);
			}
    }
    
    public function formatHash($text){
      
      $locA = strpos($text, '#');
			$locB = strpos($text, ' ', $locA+1);
		 	$len =  $locB - $locA;
			$temp = substr($text, $locA, $locB - $locA);
      $link = '<a href="https://twitter.com/hashtag/' . trim($temp, '#') . '?scr=hash">' . $temp . '</a>';
      $strt = substr($text, 0, $locA);
      $fin = substr($text, $locB);
    
      
      return $fin;
    }
    
    public function formatLink($text){
		 	$regex = '/(https?:\/\/)/';
			
      $slitText = explode(' ', $text);
      
      foreach($slitText as $item){
				if(preg_match($regex, $item)){
					$temp .= '<a href="' . $item . '">' . $item . '</a> ';
				} else {
					$temp .= $item . ' ';
				}
			}
			
			return $temp;
    }
    
		
		function getID(){
				return $this->id;
			}
		function getCreation(){
				return $this->creation;
			}
		function getName(){
				return $this->name;
			}
		function getScreenName(){
				return $this->screenName;
			}
		function getText(){
				return $this->text;
			}
		function getDisPic(){
				return $this->disPic;
			}
		function getRetweet(){
				return $this->retweet;
			}
		function getFavourite(){
				return $this->favorite;
			}
		
		function getHashSet(){
				return $this->hashSet;
			}
		
		function getPics(){
				return $this->Pics;
			}
		

  }


  

  ?>