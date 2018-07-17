<?php
require 'Autoloader.php';

  class DataAccess{
    
    
    private $member;
    private $serverName;
    private $username;
    private $password;
    private $dbConn;
    
    
    function __construct(){
      //generic constructor
    }
    
    function dbConnection(){
      
      $server = $_SERVER['SERVER_NAME'];

      $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/private/dbConfig.json");

      $obj = json_decode($json);

      switch ($server){
        case "localhost":
            $dbDetails = $obj->dev;
          break;
        case "rfo-main-site-admin73522.codeanyapp.com":
            $dbDetails = $obj->sit;
        break;
        case "www.royalflush.online":
            $dbDetails = $obj->prod;
        break;
      }

      $this->serverName = $dbDetails->serverName;
      $this->username = $dbDetails->username;
      $this->password = $dbDetails->password;
      
      try{
        $this->dbConn = new PDO("mysql:host=$this->serverName;dbname=$dbDetails->dbName", $this->username, $this->password);
        $this->dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return true;
      }
      catch (PDOException $e){
        return 'Connection error: ' . $e->getMessage();
      }
    }

    function getDbConn(){

      return $this->dbConn;
    }

    function closeConnection(){

      $this->dbConn = null;
    }
    function returnQuery($query){
      
      $this->dbConnection();
      
      $stmt = $this->dbConn->prepare($query);
      
      if($stmt->execute()){
          return $stmt;
      } else {
          return null;
      }
      $this->dbConn = null;
  }
  
    // function returnQuery($query){
      
    //   $this->dbConnection();
     
    //   $temp = $this->dbConn->query($query);
      
    //   if($temp->rowcount() > 0){
    //     return $temp;
    //   } else {
    //     return null;
    //   }

    //   $this->dbConn = null;
    // }
    
    public function insertStatement($query){
      
      $this->dbConnection();
      $this->dbConn->query($query);
      $this->dbConn = null;
    }
    
    public function nonReturnQuery($query){
      
      $responce = new Responce();
      
      $this->dbConnection();
      try{
        $this->dbConn->query($query);
        $this->dbConn = null;
        
        $responce->status = true;
        
      } catch( Exception $ex){
        
        $this->dbConn = null;
        
        $responce->errorMsg = $ex->getMessage();
        $responce->status = false;
      }
      
      return json_encode($responce);
      
    }
    
    function usrChk($user){
      
      $this->dbConnection();
      
      $sql = 'SELECT username from Users WHERE Username = "'. $user . '"';
      
      $temp = $this->dbConn->query($sql);
      
      if($temp->rowcount() > 0){
        foreach ($temp as $row){
          return $row['username'];
        }
      } else {
        return null;
      }
      
      $this->dbConn = null;
    }
    
    function passRtv($user){
      
      $this->dbConnection();
      
      $sql = 'SELECT password from Users WHERE Username = "'. $user . '"';
      
      $temp = $this->dbConn->query($sql);
      
      if($temp->rowcount() > 0){
        foreach ($temp as $row){
          return $row['password'];
        }
      } else {
        return null;
      }
   }
    
    public function passChng($hashPass, $user){
      
      $this->dbConnection();
      
      $this->dbConn->query("UPDATE Users SET password ='" . $hashPass . "' WHERE ysername = '" . $user . "'");
      
      return 'true';
    }
    
    public function passRestQuery($pass, $email){
      
      $this->nonReturnQuery("UPDATE Users SET password = '" . $pass . "' WHERE email = '" . $email . "'");
      
    }
    
    public function getUserData($user){
      
      $this->dbConnection();
      
      $sql = 'SELECT * FROM Users WHERE Username = "'. $user . '"';
      
      return $this->dbConn->query($sql);
      
      $this->dbConn = null;
    }
    
//     function insertNewUser($member){
      
//         $insert = 'INSERT INTO Users VALUES("'. $member->getFirstName() . '","' .  $member->getLastName() . '","' . $member->getEmail() . '","' .
//           $member->getUsername() . '","' . $member->getPassword() . '", CURDATE(), "unverified", "20"';
      
//         $this->insertStatement($insert);
//     }
    
    public function userActRetrive($email){
      
      return $this->returnQuery("SELECT status FROM Users WHERE email = '" . $email . "'");
    }
    
    public function srchEmail($email){
      
      $this->dbConnection();
      
      $sql = 'SELECT email from Users WHERE email = "'. $email . '"';
      
      $temp = $this->dbConn->query($sql);
      
      if($temp->rowcount() > 0){
        foreach ($temp as $row){
          return $row['email'];
        }
      } else {
        return null;
      }
      
    }
    
    public function getDisplayPic($username){
      
      $this->dbConnection();
      
      $sql = 'SELECT dis_pic from Users WHERE username = "'. $username . '"';
      
      $temp = $this->dbConn->query($sql);
      
      if($temp->rowcount() > 0){
        foreach ($temp as $row){
          return $row['dis_pic'];
        }
      } else {
        return null;
      }
    }
    
    public function updateComments($script){
      
      $this->dbConnection();
      
      $this->dbConn->query($script);
    }
    
    public function lastCommentId($type){
      
      $this->dbConnection();
      
      $sql = 'SELECT comm_id FROM Comments WHERE type = "' . $type . '" ORDER BY Entry DESC';
      
      $temp = $this->dbConn->query($sql);
      
      if($temp->rowcount() > 0){
        foreach ($temp as $row){
          return $row['comm_id'];
        }
      } else {
        return null;
      }
    }
    
    public function DBCommsMain($page, $limit){
      
      $this->dbConnection();
      
      $sql = "SELECT * 
      FROM Comments 
      WHERE page = '" . $page .
      "' AND ISNULL(ref_id)
      ORDER BY comm_id DESC
      LIMIT " . $limit;
      
      return $this->dbConn->query($sql);
      
      $this->dbConn = null;
    }
    
     public function DBCommsSub($list){
      
      $this->dbConnection();
      
      $sql = 'SELECT * 
      FROM Comments 
      WHERE ref_id 
      IN (' .  $list .')
      LIMIT 0 , 30';
      
      return $this->dbConn->query($sql);
       
       $this->dbConn = null;
    }
    
     public function runQuery($query){
      
      $this->dbConnection();
      
      return $this->dbConn->query($query);
       
      $this->dbConn = null;
    }


    
  }
?>

