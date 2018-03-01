var $dayBtn = $("#dayChoice");
  var $monthBtn = $("#monthChoice");
  var $yearBtn = $("#yearChoice");
  var $hiddenDay = $("#dayVal");
  var $hiddenMonth = $("#monthVal");
  var $hiddenYear = $("#yearVal");

//   $('#sbmtBtn').hide();

  $dayBtn.on('click', function(event){
      event.preventDefault();
  })

  $monthBtn.on('click', function(event){
      event.preventDefault();
  })

  $yearBtn.on('click', function(event){
      event.preventDefault();
  })
  
  $("#daysDropdown li a").on("click", function(){
      
      var $choice = $(this).text();
        
      $dayBtn.text($choice);
      $hiddenDay.val($choice);

      $(this).preventDefault();
  });
  
  
  $("#monthDropdown li a").on("click", function(){
      
    var $choice = $(this).text();
    
    $monthBtn.text($choice);
    $hiddenMonth.val($choice);

    $(this).preventDefault();
  });
  
  $("#yearDropdown li a").on("click", function(){
    var $choice = $(this).text();
    
    $yearBtn.text($choice);
    $hiddenYear.val($choice);
    
    $(this).preventDefault();
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

  