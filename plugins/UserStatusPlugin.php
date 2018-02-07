<?php



// function pageload1(){
  
//   $result = array();
  
//   if(isset($_SESSION['user'])){
//     echo 'first if down<br/>';
//     if(is_object($_SESSION['user'])){
//       echo 'second if down<br/>';
//       if($_SESSION['user']->getStatus() === 'verified'){
//         echo 'third if down hmmm<br/>';
//         $result['login'] = true;
//         $result['regStat'] = true;
//       } else {
//         echo 'third if fialed<br/>';
//         $result['login'] = false;
//         $result['regStat'] = false;
//       }
      
//     } else {
//       echo 'secoind if failed<br/>';
//       $result['login'] = false;
//     }
//   } else {
//     echo 'first if failed</br>';
//     $result['login'] = false;
//   }
  
//   return $result;
// }

function pageload(){
//  include 'appClass/Member.php';
  
  $result = array();
  
  if(isset($_SESSION['user'])){
    //echo 'first if down<br/>';  <-- left for any further testing
      if($_SESSION['user']['status'] === 'verified'){
      //  echo 'second if down hmmm<br/>';  <-- left for any further testing
        $result['login'] = true;
        $result['regStat'] = true;
      } else {
        //echo 'second if fialed<br/>';   <-- left for any further testing
        $result['login'] = false;
        $result['regStat'] = false;
      }
  } else {
    //echo 'first if failed</br>';   <-- left for any further testing
    $result['login'] = false;
  }
  
  return $result;
}
?>