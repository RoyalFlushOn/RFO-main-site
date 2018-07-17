<?php
//require('appClass/Comments.php');

//session_start();

//This funciton is used to diplay comments on the page calling it. The below if statements are
//used to update and collate the appropriate data so the correct comments are returned to the calling
//page.

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	updateCommentsCollection();
}

function commentsFeed($page, $limit){
  //Check if this is being accessed by a comment form and if so the currect session for comments
  //is being used and acting accordingly to those conditions.
//     if(isset($_GET['comment_' . $page])){
//       if(isset($_SESSION['comments_' . $page]) && !empty($_SESSION['comments_' .$page])
// 				&& diffTime($_SESSION['Comments_time_' . $page]) < 20){
//         updateComments($_GET['comment_' . $page]);
//        return displayFeed($page);
//         //return 'already set and through'; <--  left in for future testing if needed(05/07/2016) 
//       } else {
//         setCommentSession($page, $limit);
//         //return 'through'; <--  left in for future testing if needed(05/07/2016)
//         updateComments($_GET['comment_' . $page]);
//         return displayFeed($page);
//       }
//    } else {
//	if(isset($_SESSION['comments_time' . $page])){
	
//       if(isset($_SESSION['comments_' . $page]) && !empty($_SESSION['comments_' . $page])
// 				&& diffTime($_SESSION['Comments_time_' . $page]) < 20 ){
//         return displayFeed($page);
//         //return 'already set and ready'; <--  left in for future testing if needed(05/07/2016)
//       } else {
//         setCommentSession($page, $limit);
//         //return 'through'; <--  left in for future testing if needed(05/07/2016)
//         return displayFeed($page);
//       }
//   }
	
	
		if(isset($_SESSION['comments_' . $page])){
			if(isset($_SESSION['comments_time_' . $page])){
				if(diffTime($_SESSION['comments_time_'. $page])){
					return displayFeed($page);
// 					return 'time is true';
				} else {
					setCommentSession($page, $limit);
					
					return displayFeed($page);
					return 'time is false';
				}
			} else{
// 				setCommentSession($page, $limit);
				
// 				return displayFeed($page);
				return 'time is not set';
			}
				
		} else {
			setCommentSession($page, $limit);
			
			return displayFeed($page);
			//return 'comment not set';
		}
	}


	function diffTime($sesTime){
		
		$sesHr = substr($sesTime, 0, 2);
		$nowHr = substr(date('h:i'),0, 2);
		$sesMin = substr($sesTime, 3, 2);
		$nowMin = substr(date('h:i'),3, 2);
	
		if ($sesHr === $nowHr){
			$tot = $nowMin - $sesMin;
			
			if ($tot >= 20){
				return false;
			} else {
				return true;
			}
		} else {
			$diff = $nowMin + 60;
			
			$tot = $diff - $sesMin;
			
			
			if($tot >= 20){
				return false;
			} else {
				return true;
			}
		}
	}

//Any of the above if statements, checking if a session is set become false and call this function
//that takes the data from the database pre-packed into a collection by Comments class and placed
//into the appropriate session.
	function setCommentSession($page, $limit){
		//session_start();
		$commentsData = new Comments();
		
		
// 		foreach($_SESSION['coments_' . $page]->getCollection() as $key=>$val){
// 			if ($val->getFlag()){
// 				$update = true;
// 				break;
// 			}
// 		}
		
// 		if($update){
// 				$commnetsData->updateDatabase($_SESSION['coments_' . $pgae]->getCollection());
// 		}

		
		$comments = $commentsData->getCommData($page, $limit);

		$_SESSION['comments_' . $page] = $comments;
		$_SESSION['comments_time_' .$page] = date('h:i');
	}

//Using the comments session based on the page calling the function and returning a generated set //format for displaying comments, based on the data inside the matching session.
//Using a set of predeifned funciton with section of the overall format, these a call with in //different foreach loops to iterate throught the data coming in.
function displayFeed($pageIn){  

		$commentsCol = new Collection();
    $commentsCol = $_SESSION['comments_'.$pageIn];
    $commFeed = '';
      

    $entry = '';
    $subEntry = '';

    foreach($commentsCol->getCollection() as $key=>$val){

      $entry .= entryDisPic($val->getDisPic());

      $entry .= entryUser($val->getUser() . ' ' . $val->getID());

      $entry .= 
            entryContent(entryFormat($val->getEntry()),$val->getContent());

      $subEntry = '';

      if( $val->comments->getCount() > 0){

        foreach($val->comments->getCollection() as $key=>$val){
          $subEntry .= entryDisPic($val->getDisPic());

          $subEntry .= entryUser($val->getUser(). ' ' . $val->getID());

          $subEntry .=  entryContent(
                            entryFormat($val->getEntry()) . '<span class="text-muted">   Reply</span>' ,
                            $val->getContent() . ' Ref- ' . $val->getRefID());
          $subEntry .= ' </div>
          </div>';
        }
      }
      $entry .= $subEntry;

      $entry .=  ' </div>
          </div>';
    }

    $commFeed .= $entry;

    $commFeed .= '</div>';
 

      return $commFeed;
  
  //return $colComm;

    
}

//Currently unused due to a unkown stability when using in conjunciton with displayFeed(). 
function page($pageRaw){
        
  $temp = str_replace('/', ' ', $pageRaw);

  return str_replace('.php', ' ', $temp);
}

function updateCommentsCollection($page){
  
  $colObj = $_SESSION['comments_'. $page];
	
	if(isset($_POST['refID'])){
			$comment = Comment($_POST[''],
										$_POST[''],
										$_POST[''],
										$_POST[''],
										$_POST[''],
										$_POST['']);
	} else {
			$comment = Comment($_POST[''],
										$_POST[''],
										$_POST[''],
										$_POST[''],
										$_POST[''],
										$_POST['']);
	}
}

//this function simply returns a string containing the html mark up to display a simple 
//add comment form.
function updateformDisplay(){
  
  return '<form class="form-horizontal col-sm-6 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-offset-3 col-lg-6" 
						method="get" action="CommentsPlugin.php">
				
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
				
			</form>';
  
}

//Converts the database time and date into a custome format, converting time stamps from the same day
//as the system timestamp to "today" rather thatn date.
function entryFormat($entry){
  $date = date_format(date_create($entry), 'd/m/y');
  $time = date_format(date_create($entry), 'h:ma');
  
  if(date('d/m/y') === $date) {
    return 'Today ' . $time;
  } else {
    return $date . ' ' . $time;
  }
}

//first part of the display format, string taking in the location of the users display picture,
//adding it to the appropriate html tags.
function entryDisPic($disPic){
  
  return ' <div class="media">
        <div class="media-left">
          <img class="media-object" 
               src="'. $disPic;
}

//next part closes off the picture and adds the users register username, leaving it open for the
//last parts, date and comment text.
function entryUser($user){
  
  return '" 
               alt="display pic" 
               style="width:32px; height:32px;">
          </div>
            <div class="media-body">
              <h4 class="media-head">' . $user;
}

//Adds the date to the header, then closed that off with the comment text after it. then the whole comment format is closed ready for the next comment of the finishing off of the set.
function entryContent($entry, $content){
  
  return '<font class="text-warning"
              size="1"> ' .
              $entry .
          '</font></h4>' . $content;
}
  
?>