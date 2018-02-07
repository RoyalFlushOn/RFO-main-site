<?php 
  class Collection{
    
    private $objs = array();
    
    public function addItem($obj, $key = null) {
      
      if ($key == null){
        $this->objs[] = $obj;
      }else{
        if(array_key_exists($key, $this->objs)){
          throw new keyUsedException ('Key $key is already in use');
        } else {
          $this->objs[$key] = $obj;
        }
      }
    }

    public function deleteItem($key) {
      if(!array_key_exists($key, $this->objs)){
          throw new noKeyException ('Key $key does not exist.');
        } else {
          unset($this->objs[$key]);
        }
    }

    public function getItem($key) {
      if(!array_key_exists($key, $this->objs)){
          throw new noKeyException ('Key $key does not exist.');
        } else {
          return $this->objs[$key];
        }
    }
    
    public function editItem($obj,$key){
      if(!array_key_exists($key, $this->objs)){
        addItem($obj, $key);
        throw new addUsedException ('Key $key doesnt exist so entry created instead');
        } else {
          $this->objs[$key] = $obj;
        }
    }
    
    public function keyExists($key){
      
      if(array_key_exists($key, $this->objs)){
          return true;
        } else {
          return false;
        }
    }
    
    public function getCount(){
      
      $i = 0;
      
      foreach( $this->objs as $key=>$val){
        $i++;
      }
      
      return $i;
    }
    
    public function getCollection(){
      
      return $this->objs;
    }
  }
?>