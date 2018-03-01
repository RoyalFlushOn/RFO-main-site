<?php


class Article{
  
  private $artID;
  private $headline;
  private $mainText;
  private $author;
  private $publish;
  private $tags; // <----- in place to further dev later, this extends to any other references.
  private $commId;
  private $thumbnail;
  private $tagline;
  
  
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
  
  public function __construct6($a1, $a2, $a3, $a4, $a5, $a6){
    
    $this->artID = $a1;
    $this->headline = $a2;
    $this->author = $a3;
    $this->publish = $a4;
    $this->tagline = $a5;
    $this->thumbnail = $a6;
    $this->commId = null;
    $this->mainText = null;
    $this->tags = null;
  }

  public function __construct7($a1, $a2, $a3, $a4,$a5, $a6, $a7){
    
    $this->artID = createID();;
    $this->headline = $a1;
    $this->mainText = $a2;
    $this->author = $a3;
    $this->publish = date('Y/m/d');
    $this->tags = $a4;
    $this->commId = $a5;
    $this->thumbnail = $a6;
    $this->tagline = $a7;

  }

  public function __construct9($a1, $a2, $a3, $a4,$a5, $a6, $a7, $a8, $a9){
    
    $this->artID = $a1;
    $this->headline = $a2;
    $this->mainText = $a3;
    $this->author = $a4;
    $this->publish = $a5;
    $this->tags = $a6;
    $this->commId = $a7;
    $this->thumbnail = $a8;
    $this->tagline = $a9;

  }

  //retrieves the last entry in the recent_articles table and increases it by one
  function createID(){
    $dtAcc = new DataAccess();
    
    $preID = $dtAcc->returnQuery("select max(article_id) as 'article_id' from Recent_Articles");
    
     if($preID != null ){

       $temp = $preID->fetch(PDO::FETCH_ASSOC);

      $oldID = substr($temp["article_id"],2);

      $oldID++;

      $newId = 'AR' .  $oldID;
      } else {
        $newId = 'AR1001';
      }
    
   
    
    return $newId;
  }

  function getArticle($id){

    $dtAcc = new DataAccess();
    $temp = $dtAcc->returnQuery("select * from Articles where article_id = '" . $id . "'" );

    $temp->setFetchMode(PDO::FETCH_ASSOC);
    $art = $temp->fetchAll();

    if(is_array($art)){
      foreach($art as $a){

        $article = new Article($a['article_id'],
                                $a['headline'],
                                $a['main_content'],
                                $a['author'],
                                $a['publish'],
                                $a['tags'],
                                $a['comm_id'],
                                $a["tagline"],
                                $a['thumbnail']
                              );
        
      }
    }

    return $article;
  }

  Public function insertArticle($article){

    $log = new Logger();
    $log->startLog();

    $dtAcc = new DataAccess();
    $temp = $dtAcc->returnQuery("select min(tracker_id) as 'min' from Recent_Articles");

    $trkId = $temp->fetch(PDO::FETCH_ASSOC);
    $log->logEntry('ID = ' .$trkId['min']);

    $dtAcc->dbConnection();

    $trans = $dtAcc->getDbConn();

    $trans->beginTransaction();

    Try{
      $pre = $trans->prepare('insert into articles values ( ?,?,?,?,?,?,?,?,?)');
      // $log->logEntry($pre);

      $tempAre = Array();
      $i= 0;
      Foreach($article as $art){
        $tempArr[$i] = $art;

        $i++;
      }

      $pre->execute($tempArr);
      $log->logEntry("Inserted record into Articles matching id: " . $article->getId());

      $trans->exec("insert into Recent_Articles values(null, '" . $article->getId() . "')");
      $log->logEntry('Inserted into Recent_Articles, article id: '. $article->getId());

      $trans->exec("delete from Recent_Articles where tracker_id =" . $trkId['min']);
      $log->logEntry('Record deleted from Recent_Articles');

      $trans->commit();
      $log->logEntry('Transaction completed, process flag set to true for return');

      $flag = true;
    }
    catch (Exception $ex){
      
      $log->enter($ex->getMessage());

      //echo $ex->getMessage();

      $trans->rollBack();

      $flag = false;
    }
    $log->endLog();

    $dtAcc->closeConnection();

    Return $flag;
  }

  public function topThreeArticles(){

    $dtAcc = new DataAccess();
    $artCol = array();

    $temp = $dtAcc->returnQuery("select art.article_id, headline, author, publish, tagline, thumbnail ".
                                "from Articles art join Recent_Articles rec ". 
                                "ON art.article_id = rec.article_id");

    $temp->setFetchMode(PDO::FETCH_ASSOC);
    $arts = $temp->fetchAll();

    $i = 1;

    if(is_array($arts)){
      foreach($arts as $art){

        // $article = new Article($art['article_id'],
        //                         $art['headline'],
        //                         $art['author'],
        //                         $art['publish'],
        //                         $art["tagline"],
        //                         $art['thumbnail']);

        $artCol[ 'RA' . $i] = $art;

        $i++;
      }

      return $artCol;
    } else {
      return false;
    }
  }

  public function getId(){

    return $this->artID;
  }

  public function getHeadline(){

    return $this->headline;
  }

  public function getAuthor(){

    return $this->author;
  }

  public function getPublish(){

    return $this->publish;
  }

  public function getMaintext(){

    return $this->mainText;
  }

  public function getTags(){

    return $this->tags;
  }

  public function getCommId(){

    return $this->commId;
  }

  public function getThumbnail(){

    return $this->thumbnail;
  }

  public function getTagline(){

    return $this->tagline;
  }

}
?>