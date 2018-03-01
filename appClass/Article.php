<?php
include('appData/DataAccess.php');

class Article{
  
  private $artID;
  private $headline;
  private $mainText;
  private $author;
  private $pubDate;
//   private $tags;  <----- in place to further dev later, this extends to any other references.
  
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
  
  public function __construct4($a1, $a2, $a3, $a4){
    
    $this->artID = createID();
    $this->headline = $a1;
    $this->mainText = $a2;
    $this->author = $a3;
    $this->pubDate = $a4;
//     $this->tags = $a5;
  }
  
  //retrieves the last entry in the articles table and increases it by one
  function createID(){
    $dtAcc = new DataAccess();
    
    $preID = $dtAcc->runQuery('SELECT art_id FROM Articles ORDER BY art_id LIMIT 0, 1');
    
     if($preID->rowcount() > 0){
        foreach ($temp as $row){
          $oldID = $row['art_id'];
        }
      } else {
        $oldID = '0000';
      }
    
    $temp = $oldID + 1;
    
    return substr($oldID, 0, strlen($id)-1) . $temp;
  }
}
?>