
page = window.location.href;


$(document).ready(function(){
  
  $('#navbar').load("plugins/navbar.php", function(responseTxt, statusTxt, xhr){
    if(statusTxt == 'error'){
        console.log('navbar plugin failed');
        console.log(xhr.status + ': ' + xhr.statusText);
    } else if(statusTxt == 'success'){
        console.log('navbar plugin loaded');
    }
    
  });


  $.getScript("js/login.js").fail(function(){
      $('#scptErrLbl').text('Ooops!! Search feature has failed, please refresh. Also fingers crossed.');
      console.log("log script didnt load");
  });

  $('[data-toggle="tooltip"]').tooltip();

});
 

  
  
  var devList = $('#devList');
  
  $('ul.nav li.dropdown').hover(function() {
    var width = $(window).width();
    if (width >= 768){
      $(this).find('.dropdown-menu').stop(true, true).slideDown();
    } else {
      $(this).find('.dropdown-menu').on('click', function(){
        $(this).find('.dropdown-menu').slideDown();
      });
    }
  }, function(){
    var width = $(window).width();
    if (width >= 768){
      $(this).find('.dropdown-menu').stop(true, true).slideUp();
    }
  });