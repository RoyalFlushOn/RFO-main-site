(function () {
  "use strict";
	
	
// 	$("#testBtn").on('click', function(){
// 		$('#resDiv').html("<div class='panel panel-default'> <p>Cheese gromit<span class='text-warning'>nom nom</span></p></div>");
// 	});
	
	$('#testBtn').on('click', function(){
		var txt2 = '{"mainPic": " Random text", "body":"Smeg"}';
		
		var obj2 = JSON.parse(txt2);
		
		$('#j1').text(obj2.mainPic + ' ' + obj2.body);
		
	});
	
	
	
// 		$('button:dave').on('click', function (){
// 		if(confirm('<div class="container"><div class="row">' +
// 					'<span class="bg-warning col-sm-offset-2 col-md-offset-2 col-lg-offset-3" style="font-size:500%;">Main Title Of Article</span>' +
// 			'</div></div>') === true){
// 			 $('#res').text("yes");
// 			 } else {
// 				$('#res').text("no"); 
// 			 }
// 	});								 
// 	//------------------------artical page page JS --------------------------------------//
 var artTxt = 1;
	var pic = 1;
	var link = 1;
	var tag = 1;
	var runOrder = '';
	
  $('#btnTxtBx').on('click', function(){
		var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'art' + artTxt + 'Txt').attr("class", 'form-group');
		
		newTextBoxDiv.after().html(
			'<label class="control-label col-md-2" for="Art' + artTxt + 'Txt">Article Text ' + artTxt + '</label>' +
						'<div class="col-md-6">' +
							'<textarea class="form-control" id="Art' + artTxt + 'Txt" placeholder="Article Content here"></textarea>' +
						'</div>');
		
		newTextBoxDiv.appendTo('#artPnl');
		
		artTxt++;
		runOrder += 'art' + artTxt + 'Txt, ';
		
		$('#runOrd').text(runOrder);
	});
	
	$('#btnPic').on('click', function(){
		var newpicDiv = $(document.createElement('div'))
		.attr("id", 'art' + pic + 'Pic').attr("class", 'form-group');
		
		newpicDiv.after().html(
		'<label class="control-label col-md-2" for="art' + pic + 'Pic">Add Picture ' + pic + '</label>' +
            '<div class="col-md-6">' +
              '<input type="file" name="disPic" id="art' + pic + 'Pic" class="form-control-file">'+
            '</div>');
		
		newpicDiv.appendTo('#artPnl');
		
		runOrder += 'art' + pic + 'Pic, ';
		
		pic++;
		$('#runOrd').text(runOrder);
	});
	
	$('#btnLnkBx').on('click', function(){
		var newLnkBxxDiv = $(document.createElement('div'))
		.attr("id", 'art' + link + 'Lnk').attr("class", 'form-group');
		
		newLnkBxxDiv.after().html(
			'<label class="control-label col-md-2" for="Art' + link + 'Lnk">Article Link ' + link + '</label>' +
						'<div class="col-md-6">' +
							'<input type="text" class="form-control" id="art' + link + 'UrlLnk" placeholder="Place URL for link here">' +
							'<input type="text" class="form-control" id="art' + link + 'textLnk" placeholder="Place your text to display link here">' +
						'</div>');
		
		newLnkBxxDiv.appendTo('#artPnl');
		runOrder += 'art' + link + 'UrlLnk, art' + link + 'textLnk, ';
		
		link++;
		
		$('#runOrd').text(runOrder);
	});
	
	$('#btnTag').on('click', function(){
		var newTextBoxDiv = $(document.createElement('div'))
		.attr("id", 'art' + tag + 'Tag').attr("class", 'form-group');
		
		newTextBoxDiv.after().html(
			'<label class="control-label col-md-2" for="art' + tag + 'Tag">Article Tags, <small>(please seperate with a comma)</small> ' + tag + '</label>' +
						'<div class="col-md-6">' +
							'<input type="text" class="form-control" id="art' + tag + ' Tag" placeholder="Article Content here">' +
						'</div>');
		
		newTextBoxDiv.appendTo('#artPnl');
		
		runOrder += 'art' + tag + 'Tag, ';
		
		tag++;
		$('#runOrd').text(runOrder);
	});
	
// 	$('#finBtn').on('click', function(){
// 		var newSubBtnDiv = $(document.createElement('div'))
// 		.attr("id", 'subBtn').attr("class", 'form-group');
		
// 		newSubBtnDiv.after().html('<div class="col-md-4 col-md-offset-2">' +
// 							'<input class="btn btn-warning" id="submit" value="submit" type="submit">' +
// 						'</div>');
		
// 		newSubBtnDiv.appendTo('#artForm');
		
// 		$(this).hide();
// 	});

// 	$('#preBtn').on("click", function(){
// 		var addBtnPnl = $(document. createElement('div')).attr("id", 'optBtns').attr('class', 'btn-group');
		
// 		addBtnPnl.after().html('<button class="btn btn-success" id="moreBtn"> Continue </button><button class="btn btn-success" id="finBtn"> Finish </button>');
		
// 		addBtnPnl.appendTo('#preVwPnl');
		
// 		$(this).hide();
		
// 		$.post("appAJAX/articlePage.php", 
// 					$('#artForm').serialize(),
// 					function (data){
// 			var res = JSON.parse(data);
			
// 			if(typeof res == 'object'){
// 				addBtnPnl.after().html(res)
// 			}
			
// 		})
// 	})

		
  
  //------------------------account page JS --------------------------------------//
	
	
	//$('#passOld input').on('change', passChk($pass));
	
   function passChk(pass){
		$.post("appAJAX/accountPage.php",
					{passChk: pass},
					function(data){
// 			if(data == 'false'){
// 			  return false;
// 			} else {
// // 				$('#errOldPass').text('Found');
// 				return true;
// 			}
			//$('#errOldPass').text(data);
			
			$('#resTest').text(data);
		});
	}
	
	
	$("#passConf input").keyup(function (){
					var $testBx = $(this).val();
    	
					if($testBx !== $("#passNew").val()){
						$("#errPsdConf").css('color', '#E74C3C');
						$("#errPsdConf").text("Passwords Don't Match");
					} else {
						$("#errPsdConf").css('color', '#00bc8c');
						$("#errPsdConf").text('Password Match');
					}

				});
	
	$('#passSect').on('shown.bs.collapse', function(){
		$('a#passPnlCol').text('Click to Save');
	});
	
	$('#passSect').on('hide.bs.collapse', function(){
		
		passChk($('#passOld input').val());
		$('#txt').text($('#passOld input').val());
	
// 		if (!passChk($('#oldTxtBx').val())){
// 			e.preventDefault();
// 			$('#passSect').collapse("show");
			
// 			$('#errOldPass').text("Doesn't match original");
			
// 		} else {
// 			if ($("#errPsdConf").text() == 'Password Match'){
// 				submitForm();
// 			} else {
// 				e.preventDefault();
// 			$('#passSect').collapse("show")
// 			}
// 		}
					

	});
	
	$('#passSect').on('hidden.bs.collapse', function(){
		$('a#passPnlCol').text('Password Change');
	});

	
  $('#testForm').submit(function(event){
					event.preventDefault();
					submitForm();
				});
				
				function submitForm(){
					
					var txtval = $("#passNew").val();
					
					$.post("postTestpage.php",
						{
						test: txtval
						},
						function(data, stat){
            	$('#resTest').text(data);
// 						if(data == 'true'){
// 							$('#resTest').text('changed');
// 						}
            
					});
        }
	//------------------------forgotten password JS --------------------------------------//
// 	var $newPass = $("#newPass input");
//   var $errConfPass = $("#errConfPass");
	
// 	$('#confPass').on("change", function(){
// 		var $passchk = $(this).val();
    
//     if ($newPass.val() !== $passchk ){
//       $errConfPass.css('color', '#E74C3C');
//       $errConfPass.text('Passwords dont match!');
//     } else {
//       $errConfPass.css('color', '#00bc8c');
//       $errConfPass.text('Passwords match.');
//     }
// 	});
	
//------------------------registeration JS --------------------------------------//
  var $dayBtn = $("#dayChoice");
  var $monthBtn = $("#monthChoice");
  var $yearBtn = $("#yearChoice");
  var $hiddenDay = $("#dayVal");
  var $hiddenMonth = $("#monthVal");
  var $hiddenYear = $("#yearVal");
  
  $("#daysDropdown li a").on("click", function(){
    var $choice = $(this).text();
    
   $dayBtn.text($choice);
   $hiddenDay.val($choice);
  });
  
  
  $("#monthDropdown li a").on("click", function(){
    var $choice = $(this).text();
    
    $monthBtn.text($choice);
    $hiddenMonth.val($choice);
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
  
   //--------------------------------------------------------------------------------//
  
  //--------------------------- Navigation bar------------------------------------//
  
  
  
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
  
  
 //--------------------------------------------------------------------------------// 
  
  
//   $inputComp.on("change", function(){});
  
//   function passComp(){
  
//     if($pass != $compPass){
//       $errPassChk.val('Passwords dont match, <p class="text-danger">Passwords dont match!</p>');
//     } else {
//       $errPassChk.val('Passwords match, <p class="text-success">Passwords dont match!</p>');
//     }
//   }
 
  
//   var $pickButton = $("#pickButton");
  
//   $("#reasonDropdown li a").on("click", function(){
//     var reason = $(this).text();
//     $pickButton.text(reason);
//   });
  
//   $("#contactForm input[type=submit]").tooltip({
//     delay: {
//       show: 600,
//       hide: 0
//     }
//   });
  
//   $("#contactForm").on("submit", function() {
//      $sentDialog.modal('show');
//      return false;
//                        });
  
//   var $sentAlert = $("#sendAlert");
  
//   $sentDialog.on("hidden.be.modal", function(){
//     //alert("close");
//     $sentAlert.show();
//                  });
  
//   $sentAlert.on("close.bs.alert", function(){
//     $sentAlert.hide();
//     return false;
//   });
  
//   $("#theCarousel").carousel();
  
})();

