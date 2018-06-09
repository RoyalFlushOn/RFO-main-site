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
        }

        public function createJsonString(){

            $this->jsonString = '{ "content" : "' . $this->content . '", "type" : "' . $this->type . '" }';
        }

        public function createJsonObject(){

            $this->jsonObject = json_decode($this->jsonString);
        }

        public function addMessageToSession(){
            if(isset($_SESSION['message'])){
                unset($_SESSION['message']);   
            }

            $_SESSION['message'] = $this->getJsonString();
        }

        public function getJsonString(){

            $this->createJsonString();
            return $this->jsonString;
        }

        public function getJsonObject(){
            return $this->jsonObject;
        }
    }
?>