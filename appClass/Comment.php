<?php

  include('appData/DataAccess.php');
	include('appClass/Collection.php');
  class Comment {
    
    private $commID;
    private $username;
		private $page;
		private $disPic;
    private $entry;
    private $text;
    private $type;
    private $refID;
		private $newFlag;
		public $comments;
    
   function __construct(){
      $a = func_get_args();
			$i = func_num_args();
			
			if(method_exists($this, $f='__construct'.$i)){
				call_user_func_array(array($this,$f), $a);
			}
    }
		
		public function __construct0(){
			
		}
		
		public function __construct1($a1){
			
			$this->comments = new Collection();
			$this->comments->addItem($a1, $a1->getID());
		}
    
		//creating a comment obj from a user entered comment not database.
    public function __construct5($a1, $a2, $a3, $a4, $a5){
       
      $this->commID = $this->genCommId($a5);
      $this->username = $a1;
			$this->page = $a2;
			$this->disPic = $this->retriveDP($a1);
      $this->entry = $a3;
      $this->text = $a4;
      $this->type = $a5;
			$this->newFlag = true;
			$this->comments = new Collection();
    }
		
		//creating a comment obj with reference to another comment from 
		//a user not database.
		public function __contruct6($a1, $a2, $a3, $a4, $a5, $a6){
			
			$this->commID = $this->genCommId($a5);
      $this->username = $a1;
			$this->page = $a2;
			$this->disPic = $this->retriveDP($a1);
      $this->entry = $a3;
      $this->text = $a4;
      $this->type = $a5;
			$this->refID = $a6;
			$this->newFlag = true;
			$this->comments = new Collection();
		}
		
		//create a comment obj from database entries for both main and sub.
		public function __construct7($a1, $a2, $a3, $a4, $a5, $a6, $a7){
			
			if($a7 === null){
				$this->commID = $a1;
				$this->username = $a2;
				$this->page = $a3;
				$this->disPic = $this->retriveDP($a2);
				$this->entry = $a4;
				$this->text = $a5;
				$this->type = $a6;
				$this->newFlag = false;
				$this->comments = new Collection();
			} else {
				$this->commID = $a1;
				$this->username = $a2;
				$this->page = $a3;
				$this->disPic = $this->retriveDP($a2);
				$this->entry = $a4;
				$this->text = $a5;
				$this->type = $a6;
				$this->refID = $a7;
				$this->newFlag = false;
				$this->comments = new Collection();
			}
			
			
		}
    
    public function genCommId($type){
      
      $dtAcc = new DataAccess();
      
      $temp = $dtAcc->lastCommentId($type);
			
			return $temp++;
    }
		
		public function retriveDP($user){
			
			$dtAcc = new DataAccess();
			
			return $dtAcc->getDisplayPic($user);
		}
		
		
		public function getID(){
			
			return $this->commID;
		}
		
		public function getUser(){
			
			return $this->username;
		}
		
		public function getPage(){
			
			return $this->page;
		}
		
		public function getEntry(){
			
			return $this->entry;
		}
		
		public function getDisPic(){
			
			return $this->disPic;
		}
		
		public function getContent(){
			
			return $this->text;
		}
		
		public function getRefID(){
			
			return $this->refID;
		}
		
		public function getType(){
			
			return $this->type;
		}
		
		public function getFlag(){
			return $this->newFlag;
		}
		
  }
?>