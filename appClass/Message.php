<?php
    class Message{
        private $content;
        private $type;
        private $jsonString;
        private $jsonObject;

        function __construct(){
            $a = func_get_args();
                  $i = func_num_args();
                  
                  if(method_exists($this, $f='__construct'.$i)){
                      call_user_func_array(array($this,$f), $a);
                  }
          }
      
        
        public function __construct0(){
          //generic constructor
        }

        public function __construct2($a1,$a2){
            
            $this->content = $a1;
            $this->type = $a2;

            $this->createJsonString();
            $this->createJsonObject();
        }

        private function createJsonString(){

            $this->jsonString = '{ "content" : "' . $this->content . '", "type" : "' . $this->type . '" }';
        }

        private function createJsonObject(){

            $this->jsonObject = json_decode($this->jsonString);
        }

        public function getJsonString(){
            return $this->jsonString;
        }

        public function getJsonObject(){
            return $this->jsonObject;
        }
    }
?>