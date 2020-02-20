<?php
include 'Autoloader.php';

class Article{
  
  private $artID;
  private $headline;
  private $content;
  private $author;
  private $publish;
  private $tags; // <----- in place to further dev later, this extends to any other references.
  private $commId;
  private $tagline;
  private $thumbnail;
  private $isValidated;
  
  
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
    $this->content = null;
    $this->tags = null;
  }

  public function __construct7($a1, $a2, $a3, $a4,$a5, $a6, $a7){
    
    $this->artID = $this->createID();
    $this->headline = $a1;
    $this->content = $a2;
    $this->author = $a3;
    $this->publish = date('Y/m/d');
    $this->tags = $a4;
    $this->commId = $a5;
    $this->thumbnail = $a6;
    $this->tagline = $a7;

  }

  //constuctor for new article being created
  public function __construct9($a1, $a2, $a3, $a4,$a5, $a6, $a7, $a8, $a9){
    
    $this->artID = $a1;
    $this->headline = $a2;
    $this->content = $a3;
    $this->author = $a4;
    $this->publish = date('Y/m/d');
    $this->tags = $a5;
    $this->commId = $a6;
    $this->tagline = $a7;
    $this->thumbnail = $a8;
    $this->isValidated = $a9;

  }
  
  //contructor for retrieving an article for display
  public function __construct10($a1, $a2, $a3, $a4,$a5, $a6, $a7, $a8, $a9, $a10){
    
    $this->artID = $a1;
    $this->headline = $a2;
    $this->content = $a3;
    $this->author = $a4;
    $this->publish = $a5;
    $this->tags = $a6;
    $this->commId = $a7;
    $this->tagline = $a8;
    $this->thumbnail = $a9;
    $this->isValidated = $a10;

  }

  //retrieves the last entry in the recent_articles table and increases it by one
  function createID(){
    $dtAcc = new DataAccess();
    
    $preID = $dtAcc->returnQuery("select max(article_id) as 'article_id' from Recent_Articles");
    $temp = $preID->fetch(PDO::FETCH_ASSOC);
    
     if($temp['article_id'] != null){

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
                                $a['content'],
                                $a['author'],
                                $a['publish'],
                                $a['tags'],
                                $a['comm_id'],
                                $a["tagline"],
                                $a['thumbnail'],
                               $a['is_validated']
                              );
        
      }
    }

    return $article;
  }

  public function insertArticle($article, $userLevel){

    // $log = new Logger();
    // $log->startLog();
    $trackerId = 0;
    $responce = new Responce();

    $dtAcc = new DataAccess();
    
     $temp = $dtAcc->returnQuery("select min(tracker_id) as 'min', count(tracker_id) as 'count' from Recent_Articles");

      $trkId = $temp->fetch(PDO::FETCH_ASSOC);
    
    if($trkId['count'] == 3 ){
     
        $trackerId = $trkId['min'];
      
    }
    // $log->logEntry('ID = ' .$trkId['min']);
    
    

    $dtAcc->dbConnection();

    $trans = $dtAcc->getDbConn();

    $trans->beginTransaction();

    Try{
      $pre = $trans->prepare('insert into Articles values ( ?,?,?,?,?,?,?,?,?,?)');
      // $log->logEntry($pre);

      $tempAre = Array();
      $i= 0;
      foreach($article as $art){
        $tempArr[$i] = $art;

        $i++;
      }

      /**
       * start of transaction to add the article data from the form, then update the recent article table
       * by deleting the oldest entry from the table and adding the id from the new one.
       */
      
      $pre->execute($tempArr);  //adding form data to Article table 
      // $log->logEntry("Inserted record into Articles matching id: " . $article->getId());

      if($userLevel == 99){
        //adding the forms article if to the recent_article Table.
      $trans->exec("insert into Recent_Articles values(null, '" . $article->getId() . "')");
      // $log->logEntry('Inserted into Recent_Articles, article id: '. $article->getId());

      //using the minimum Recent_articles id from above to delete that entry from the recent_articles 
      //table
        if($trackerId != 0){
          $trans->exec("delete from Recent_Articles where tracker_id =" . $trackerId);
        }
      
      }
      // $log->logEntry('Record deleted from Recent_Articles');

      //Commit these changes to the DB
      $trans->commit();
      // $log->logEntry('Transaction completed, process flag set to true for return');

      if($userLevel == 99){
        unset($_SESSION['topArticles']);
      }
      $responce->flag = true;
    }
    catch (Exception $ex){
      
      // $log->enter($ex->getMessage());

      $responce->errormsg = $ex->getMessage();

      //problem with db commands so transaction is being rolled back
      $trans->rollBack();

      // $flag = false;
      $responce->flag = false;
    }
    // $log->endLog();

    $dtAcc->closeConnection();

    return $responce;
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
      if(count($arts) > 0){
          foreach($arts as $art){

            $artCol[ 'RA' . $i] = $art;

            $i++;
          }
      
        switch(count($arts)){
          case 1:
            $artCol["RA2"] = $this->defaultDisplayContent();
            $artCol['RA3'] = $this->defaultDisplayContent();
            break;
          case 2:
            $artCol['RA3'] = $this->defaultDisplayContent();
        }

        
      } else {
        $artCol["RA1"] = $this->defaultDisplayContent();
        $artCol["RA2"] = $this->defaultDisplayContent();
        $artCol["RA3"] = $this->defaultDisplayContent();
      }
      
      return $artCol;
      
    } else {
      
      $artCol["RA1"] = $this->defaultDisplayContent();
      $artCol["RA2"] = $this->defaultDisplayContent();
      $artCol["RA3"] = $this->defaultDisplayContent();
      
     return $artCol;    
    }
  }
  
  public function getTenMostRecentArticles(){
    
    $dtAcc = new DataAccess();
    $artCol = array();

    $temp = $dtAcc->returnQuery("select article_id, headline,tagline, thumbnail ".
                                "from Articles order by publish desc limit 1, 10");
    
    $temp->setFetchMode(PDO::FETCH_ASSOC);
    
    $arts = $temp->fetchAll();
    
    $i = 1;

    if(is_array($arts)){
      return $arts;
    } else {
      return false;
    }
  }
  
  private function defaultDisplayContent(){
    $headline = "This is where the Article Headline would be displayed";
    $tagline = "A blub about you article will be displayed here, we refer them as taglines";
    
    return array('headline' => $headline, 'tagline' => $tagline, 'thumbnail' => 'https://placeimg.com/300/300/tech/grayscale');
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

    return $this->content;
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