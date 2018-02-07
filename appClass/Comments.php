<?php

  //require('appClass/Collection.php');
  //include('appData/DataAccess.php');
  include('appClass/Comment.php');
  class Comments{
    
    private $main;
    private $sub;
    private $comment;
    private $comments;
    
    public function __constructor(){
      
    }
    
    public function getCommData($page, $limit){
      
      $dtAcc = new DataAccess();
      
      $this->main = $dtAcc->DBCommsMain($page, $limit);
      
      $this->processMainData();
      
      $this->sub = $dtAcc->DBCommsSub($this->IDList());
      
      $this->processSubData();
      
      return $this->comments;
    }
      public function IDList(){
        
        $temp = "'";
        
        foreach ($this->comments->getCollection() as $key=>$val){
          $temp .= $val->getID() . "','";
        }
        
        return $temp . "'";
      }
    

    public function processMainData(){
      
      $this->comments = new Collection();
      
      foreach($this->main as $item){
          
          $this->comment = new Comment($item['comm_id'], $item['username'], $item['page'], $item['entry'], $item['content'], $item['type'], null);
          
          $this->comments->addItem($this->comment, $item['comm_id']);
        }
    }
    
    public function processSubData(){
      
        foreach($this->sub as $item){
          
          if($this->comments->keyExists($item['ref_id'])){
              
            $this->comment = new Comment($item['comm_id'], $item['username'], $item['page'], $item['entry'], $item['content'], $item['type'], $item['ref_id']);
            
            $temp = $this->comments->getItem($item['ref_id']);
            
            $temp->comments->addItem($this->comment, $item['comm_id']);
            
            $this->comments->editItem($temp, $item['ref_id']);
          }
        }
                
    }
  
    public function updateComments($comments){
      $query = '';
      foreach($comments as $key=>$val){
        if($val->getFlag()){
          $query.= "INSERT INTO Comments Values('" .
                                  $val->getID() . "','" .
                                  $val->getPage() . "','" .
                                  $val->getUser() . "','" .
                                  $val->getEntry() . "','" .
                                  $val->getContent() . "','" .
                                  $val->getType() . "'" ;
          if($val->GetType() === 'sub'){
            $query.= ", '" . $val->getRefID() . "'"; 
          }
          
          $query.= ");";
        }
        $dtAcc = new DataAccess();
          
        $dtAcc->commentUpdate($query);
      }
      
    }
    
    public function getMain(){
      
      return $this->main;
    }
    
        
    public function getSub(){
      
      return $this->sub;
    } 
          
 }
      
?>