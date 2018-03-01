<?php  //session_start(); ?>-->

<html>

 <?php 


	//namespace Emojione;
	// session_start();
	
	// session_destroy();

	// if(!$_GET['npsw'] == null ){
	// 	  echo 'found get';
	//   } else {
	// 	  header("Location:index.php?msg=Ooow+sorry+that+is+not+allowed.+Bye&type=info");
	//   }
?>
	
	<head>
		  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!--         <link rel="stylesheet" href="css/bootstrap-theme-dark.css">  -->
       <link rel="stylesheet" href="css/theme.css">
	   
      
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
				
	</head>
  <?php 



// include 'appClass/Autoloader.php';

// if($_SERVER['REQUEST_METHOD'] == 'POST'){

	// $fileJson = $_POST['file'];

	// print_r($fileJson);

	// $fileObj - json_decode($fileJson);

	// print_r($fileObj);

	

// 		if(!empty($_POST['txtBxTest'])){
// 			echo $_POST['txtBxTest'];
// 		}
		
		if(isset($_FILES['file'])){

			if($_FILES['file']['size'][0] > 0){
				$nameArr = $_FILES['file']['name'];
				$tmp_name = $_FILES['file']['tmp_name'];
				$errArr = $_FILES['file']['error'];

				$temp = basename($nameArr[0]);

				echo $temp;
				echo'</br>';
				echo $nameArr[0];
				echo'</br>';
				echo $tmp_name[1];
				echo'</br>';
				echo $ext =  pathinfo($temp, PATHINFO_EXTENSION);

				if($ext == 'html'){
					echo '<br/> files .html';
				} else if($ext == 'txt'){
					echo '<br/> files .txt';
				} else {
					echo '<br/> should not see this yet';
				}

				// if (strcmp($ext, 'txt') != 0 OR strcmp($ext, 'html') != 0){
				// 	echo '<br/> hmmm why did it work this time?';
				// } else {
				// 	echo '<br/> smeg, try again';
				// }
			} else {
				echo 'no file present';
			}

			
		}

		// if(!empty($_POST['txtBxTest2'])){
		// 	echo '</br>' . $_POST['txtBxTest2'];
		// }
// }

// echo __DIR__;

// echo "</br>" . subStr(__DIR__, 0,strlen(__DIR__) - strlen('/testing'));





// $temp = $_SESSION['topArticles'];

// $art = $temp->getItem('RA1');

// //   echo $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.'Article.php';
  
//   echo $art->insertArticle($art2);
  
//   echo '<br/>';
// 	$temp = $art->topThreeArticles();
//   print_r($temp);

//   echo '</br>';

//   $art =  $temp->getItem('RA1');
//   print_r($art);

//   echo '</br>';

//   echo $art->getId();

//   echo '</br>';

//   echo $art->getHeadline();

  	// if(!$_GET['npsw'] == null ){
	// 	  echo 'found get';
	//   } else {
	// 	  header("Location:index.php?msg=Ooow+sorry+that+is+not+allowed.+Bye&type=info");
	//   }
 		//include('appData/DataAccess.php');
	
// 		$dtAcc  = new DataAccess();
// 		//$dtAcc->dbConnection();
	
// 	echo $dtAcc->lastCommentId('main');
// 		echo $dtAcc->passRtv('MrGavtastic');
// 		echo '<br/>';
	
// 		if(is_null($dtAcc->passRtv('test'))){echo 'pass';}
	
	
// 	echo $dtAcc->dbConnection() . '<br/>';
// 	$temp = $dtAcc->select();
	
// 	if($temp->rowCount() > 0){
		
// 		foreach ($dtAcc->select() as $row){
// 			echo $row['username'];
// 		} 
		
// 	} else {
// 		echo 'not there';
// 	}
	
		
	

	
// 	$firstName = 'aaaaa1A';
// 	$regx = "/\s/"; //looks for white spaces
// 	$regx2 = "/[0-9\s]/"; //looks for numbers and spaces
// 	$regx3 = "/(?=.{8,})/"; //looks for a minimum of 8 characters
// 	$regx4 = "/(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/"; // password
		
// 	if(!preg_match($regx4, $firstName)){
// 		$errFstNm = '<p class="text-warning">Please only use letters.</p.>';
// 	} else {
// 		$errFstNm = '<p class="text-success">Yay!</p>';
// 	}

	 //include('appClass/Collection.php');
	
//  class Test{
	 
	
	 
// 	 private $id;
// 	 private $x;
// 	 private $y;
// 	 public $testCol;
	 
// 	  function __construct(){
//       $a = func_get_args();
// 			$i = func_num_args();
			
// 			if(method_exists($this, $f='__construct'.$i)){
// 				call_user_func_array(array($this,$f), $a);
// 			}
//     }
	 
// 	 function __construct0(){
		 
// 	 }	 
	 
// 	 function __construct1($a1){
		 
// 		 $this->col = new Collection();
// 	 }
// 	 function __construct3( $a1, $a2, $a3){
		 
// 		 $this->id = $a1;
// 		 $this->x = $a2;
// 		 $this->y = $a3;
// 		 $this->testCol = new Collection();
// 	 }
	 
// 	 function getX(){
// 		 return $this->x;
// 	 }
	 
// 	 function getY(){
// 		 return $this->y;
// 	 }
	 
// 	 function getID(){
		 
// 		 return $this->id;
// 	 }
	 
//  }	
	
	

	
	
	
	?>
  <body>

		<div class="container">
			<a href=".">Home</a>
			<br/>
			
		<br/>

		

		<!--<p id="file"></p>-->

		<!--<script>
			function jsonTest(){
				var files = $('#fileTest').prop('files');

				var reader = new FileReader();

				reader.onload = function(){
					var text = reader.result;

					$('#output').text(text);
				};
				reader.readAsText(files[0]);
			}
		</script>

		<div id="input">
			<form id="form" class="form-horizontal">
				<div class="form-group">
				<input type="file" name="fileTest" id="fileTest" class="form-control-file" onchange="jsonTest()">
				<img src="images/site-images/file-uploads/appbar.page.check.png" class="img">
				</div>
			</form>
		</div>

		<div>
			<label id="output"></label>
		</div>-->
		<!--<form method="post" action="scratPad.php" enctype="multipart/form-data" class="form-horizontal">

			<div class="panel" id="testPnl">
			<script>
				$('#testPnl').load('scratInject.php');
				var test = "fingers crossed";
			</script>

				
			</div>

			<div class="form-group">
				<input type="submit" name="submit" value="Submit "class="form-control">
			</div>
		</form>-->

		<form method="post" action="scratPad.php" enctype="multipart/form-data" class="form-horizontal">

		<div class="panel">

			<div class="form-group">
				<input type="text" name="txtBxTest" id="txtBxTest" class="form-control">
			</div>
			
			<div class="form-group">
				<input type="file" name="file[]" id="filestuff" class="form-control-file">
			</div>

			<div class="form-group">
				<input type="file" name="file[]" id="imageStuff" class="form-control-file">
			</div>

			<div class="form-group">
				<input type="text" name="txtBxTest2" id="txtBxTest" class="form-control">
			</div>

			<div class="form-group">
				<input type="submit" name="submit" value="Submit "class="form-control">
			</div>
			</div>
		</form>
		<!--	<form class="form-horizontal col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-offset-3 col-lg-6" 
						method="get" action="scratPad.php">
				
				<div class="form-group">	
					<lable for="comment" class="control-lable"><h4>Add Comment</h4></lable>
					<div>
						<textarea name="comment" class="form-control" placeholder="Comment text here...">
						</textarea>
					</div>
				</div>
				
				<div class="form-group">
            <div class="">
              <input type="submit" value="submit" class="btn btn-success" /> 
              <label class="control-label"><?php //echo $sucess; ?></label>
            </div>
				</div>
				
				
			</form>-->
			
			<br/>
			<script>
			var nothing = "";
			var something = 'text';

			var nLen = nothing.length;
			var sLen = something.length;

			if(nothing.length > 0){
				$('#txtBxTest').val('thats not right');
			} else {
				$('#txtBxTest').val('thats wat I wanted to see');
			}

			if(something.length == 0){
				$('#txtBxTest2').val('thats not right');
			} else {
				$('#txtBxTest2').val('thats wat I wanted to see');
			}
		</script>
			


		</div>

		<?php 
		
		//include "appData/DataAccess.php";
		
			// require 'appClass/Member.php';
			
			
			//echo password_hash('cheese', PASSWORD_DEFAULT);	
				
				
		
		
		//$dtAcc = new DataAccess();
		
		//echo $dtAcc->dbConnection();
		
		/*session_start();
		
		echo $temp = $_SESSION['start_time'];
		echo '<br/>';
		echo $finTime = date('h:i');
		echo '<br/>';
		
		echo $a = substr($temp, 0, 2);
		echo '<br/>';
		echo $b = substr($finTime,0, 2);
		echo '<br/>';		
		echo $c = substr($temp, 3, 2);
		echo '<br/>';
		echo $d = substr($finTime,3, 2);
		echo '<br/>';
		
		if ($a === $b){
			echo $tot = $d - $c;
			echo '<br/>';
			if ($tot >= 15){
				echo 'true';
			} else {
				echo 'False';
			}
		} else {
			echo $diff = $d + 60;
			echo '<br/>';
			echo $tot = $diff - $c;
			'<br/>';
			
			if($tot >= 15){
				echo 'true';
			} else {
				echo 'false';
			}
		}*/
// 			include('appClass/Member.php');
// 		include('appData/DataAccess.php');
			
// 			$dtAcc = new DataAccess();
			
// 			$temp = $dtAcc->getUserData('MrGavtastic');
			
// 			foreach($temp as $item){
// 					$newMember = new Member(
// 					$item['first'],
// 					$item['second'],
// 					$item['email'],
// 					$item['username'],
// 					$item['status'],
// 					$item['level'],
// 					$item['dis_pic']);
// 			}
				
// 				//echo var_dump($newMember);
		
// 		session_start();
		
// 		$_SESSION['test'] = $newMember;
		
// 		$obj = $_SESSION['test'];
		
// 		echo '<br/>' . var_dump($obj) . '<br/>';
		
// 		echo $_SESSION['test']->getFirstName() . '<br/>';
		
// 		echo $obj->getEmail();
// 			include('CommentsPlugin.php');
			//include('appData/DataAccess.php');
			
			//echo commentsFeed('/index.php', '0, 10');
			
			//$comment = new Comments();
			//$dtAcc = new DataAccess();
			
		 //echo var_dump($comment->getCommData('index', '0, 10'));
			//setCommentSession('index', '0, 10');
			
			//echo var_dump($_SESSION['comments_index']);
			
			//echo var_dump(displayFeed(page('/index.php')));
			
// 			echo displayFeed('index');
			
// 			echo '<br/>' . $_SERVER['PHP_SELF'] . '<br/>';
			
// 			echo page($_SERVER['PHP_SELF']);
			
			//echo var_dump(commentsFeed('/index.php', '0, 10'));
			
// 			foreach ($_SESSION['comments_index'] as $key=>$val){
				
// 				echo $val->getID() . '<br/>';
// 			}
			
// 			$temp = 10;
			
			
// 			echo $temp . '<br/>';
// 			echo $temp . '<br/>';
// 			echo $temp . '<br/>';
// 			echo $temp . '<br/>';
			
// 			$dbData = $dtAcc->DBCommsMain('index', '0, 10');
			
// 			foreach($dbData as $item){
				
// 				echo $item['comm_id'] . '<br/>';
// 			}
			
// 			foreach($dbData as $item){
				
// 				echo $item['comm_id'] . '<br/>';
// 			}
			 
			
// 			foreach($comment->getMain() as $item){
				
// 				echo $item['comm_id'] . '<br/>';
// 			}
			
// 			foreach($comment->getMain() as $item){
				
// 				echo $item['comm_id'] . '<br/>';
// 			}
// 			foreach($comment->getSub() as $item){
				
// 				echo $item['comm_id'] . '<br/>';
// 			}
			
// 			if(isset($_SESSION['comments_index'])){
// 				foreach ($_SESSION['comments_index'] as $key=>$value){
// 					echo $vlaue['comm_id'] . '<br/>';
// 				}
// 			} else {
// 				setCommentSession('index', '0, 10');
// 				echo 'should be ready';
// 			}
// 			echo $_SERVER['PHP_SELF'];
// 			echo '<br/>';
			
// 			echo $temp = str_replace('/', ' ', $_SERVER['PHP_SELF']);
// 			echo '<br/>';
// 			echo $temp = str_replace('.php', ' ', $temp);
			
// 	$test1 = new Test('A',1 ,2);
// 	$test2 = new Test('B', 3 ,4);
// 	$test3 = new Test('C',5 ,6);
// 	$test4 = new Test('D',7 ,8);
// 	$test5 = new Test('E',9 ,10);
	
// 	$testCol = new Collection();
	
// 	$testCol->addItem($test1, $test1->getID());
// 	$testCol->addItem($test2, $test2->getID());
// 	$testCol->addItem($test3, $test3->getID());
// 	$testCol->addItem($test4, $test4->getID());
// 	$testCol->addItem($test5, $test5->getID());
			
// 	$test6 = new Test('F',11 ,'A');
// 	$test7 = new Test('G', 13 ,'B');
// 	$test8 = new Test('H',15 ,'C');
// 	$test9 = new Test('I',17 ,'D');
// 	$test10 = new Test('J',19 ,'E');
			
// 		$temp =	$testCol->getItem($test6->getY());
			
// 		$temp->testCol->addItem($test6, $test6->getID());
			
// 		echo	$temp->testCol->getCount();
			
	
// 	//$temp = new Test();
// 	$temp = $testCol->getCollection();
			
// 			foreach ($temp as $key=>$value){
// 				echo $value->getX() . '<br/>';
// 			}
			
			
// 	echo $temp->getX() . '<br/>';

// 			$tempCol = $testCol->getItem('A');
			
// 			$tempCol->col->additem($test2, $test2->getID());
			
// 			$coltemp = $tempCol->col->getItem('B');
// 			echo $coltemp->getX();
			
// 			$dtAcc = new DataAccess();
			
// 			$pic = $dtAcc->getDisplayPic('MrGavtastic');	
// 	$val1 = 'content';
// 	$val2;
	
// 	$arrayTest = array('key' => $val1, 'key2' => $val2);


// 			?>
		<br/>

		
		<br/>
		
		
	
  </body>

	<!--<script src="js/site.js"></script>-->
	
</html>