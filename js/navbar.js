$(document).ready(function(){
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