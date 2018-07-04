<?php 
require_once '../appClass/Autoloader.php'; 

class ContactUs {
  
  private $subject;
  private $contact;
  private $content;
  private $status;
  
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
  
  public function __construct3($a1, $a2, $a3){
    $this->subject = $a1;
    $this->contact = $a2
    $this->content = $a3;
  }
  
  public function __construct4($a1, $a2, $a3, $a4){
    $this->subject = $a1;
    $this->contact = $a2
    $this->content = $a3;
    $this->status = $a4;
  }
  
  
  public function store(){
    
    $dtAcc = DataAccess();
    
    $res = $dtAcc->nonReturnQuery('insert into Conact(subject, contact, content, status) 
                                    Values ('. $this->subject. ',' . 
                                                $this->contact. ',' . 
                                                $this->content. ',' .
                                                '"unread")');
    
    return $res;
    
  }
  
}
?>