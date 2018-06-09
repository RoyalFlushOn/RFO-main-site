var $dayBtn = $("#dayChoice");
  var $monthBtn = $("#monthChoice");
  var $yearBtn = $("#yearChoice");
  var $hiddenDay = $("#dayVal");
  var $hiddenMonth = $("#monthVal");
  var $hiddenYear = $("#yearVal");

  $('#submitButton').hide();
  
  $("#daysDropdown li a").on("click", function(){
      
      var $choice = $(this).text();
        
      $dayBtn.text($choice);
      $hiddenDay.val($choice);
  });
  
  
  $("#monthDropdown li a").on("click", function(){
      
    var $choice = $(this).text();
    
    $monthBtn.text($choice);
    $hiddenMonth.val($choice)
  });
  
  $("#yearDropdown li a").on("click", function(){
    var $choice = $(this).text();
    
    $yearBtn.text($choice);
    $hiddenYear.val($choice);

  });
  
  var $pass = $("#pass");
  var $inputComp = $("#passChk");
  var $errPassChk = $("#errPsdChk");
  
  $("#passChkDiv input").on("change", function(){
    var $passchk = $(this).val();
    
    if ($pass.val() !== $passchk ){
      $errPassChk.css('color', '#E74C3C');
      $errPassChk.text('Passwords dont match!');
    } else {
      $errPassChk.css('color', '#00bc8c');
      $errPassChk.text('Passwords match.');
    }
  });

  