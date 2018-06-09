

var artTxt = 1;
var pic = 1;
var linkI = 1;
var tag = 1;
var arrOrder = 1;
var ielmt = 0;
var artArr = [];
var elmtArr = [];

var uploadPnl = $('#uploadPnl');
var uploadDiv = $('#uploadDiv')
var formContent = $('#formContent');
var choiceDiv = $('#choiceDiv');
var artNav = $('#artNavbar');
var previewbtn = $('#preDiv');
var pnlType = $('#pnlType');



arrOrder = arrOrder + 3;

// $('#uploadBtn').on('click', function(){
//     uploadPnl.show("slow");
//     choiceDiv.slideUp();
// })

$('#createBtn').tooltip({
    title:'<h3><span class="text-warning">Coming Soon</span></h3>', 
    html: true, 
    placement:"bottom"
});

function openPnl(e){

    if(e.id.includes('upload')){
        formContent.load('plugins/articleUpload.php');
        uploadDiv.show('slow');
        pnlType.val('upload');
        setup('upload');
    } else {
        formContent.load('plugins/articleCreate.php');
        uploadDiv.css('padding', '100px');
        uploadDiv.show('slow');
        artNav.show('slow');
        pnlType.val('create');
        setup('create');
    }
    choiceDiv.slideUp();
    previewbtn.show();
}

function closePnl(e){
    type = pnlType.val();

    if(type.includes('Up')){
        uploadDiv.slideUp();
    } else {
        uploadDiv.slideUp();
        artNav.slideUp();
        uploadDiv.css('padding', '0px');
    }
    choiceDiv.show('slow');  
    previewbtn.slideUp();   
}

function setup(formType){
    if(formType.includes('upload')){
        setupUpload();
    } else {
        setupCreate();
    }
}

function setupUpload(){
    
    // this is where code will be when preview file feature is created.

}

function setupCreate(){

    addHeadline();

    if($('#headLnPicChkBx').is(':checked')){
        removePic($('#headLnPicChkBx'));
    } else {
        artArraySetup(arrOrder, "headLnPic");
    }

}




$('#btnTxtBx').on('click', function(){
	
	addText();

});

// $('#btnPic').on('click', function(){

//   imageMain(arrOrder + 1);

//   artArraySetup(arrOrder, "imageMain")
  
//   arrOrder = arrOrder + 3;
//   pic++;

// });

$("#picDropDown li a").on('click', function(){

    var choice = $(this).text();
    imageType(choice);

})

$('#btnLnkBx').on('click', function(){

    if(artArr[arrOrder-1].includes('</p>')){

        linkInline();
        // link(arrOrder);

        // artArraySetup(arrOrder-1, "linkInline");
        // arrOrder = arrOrder + 3;

        // textBox(arrOrder+1);
        // artArraySetup(arrOrder, "linkText");

        // arrOrder = arrOrder + 3;
        // linkI++;

    } else {
        res = confirm("Do You want to Start a sentence with a link?");

        if(res){

            linkStart();
            // link(arrOrder + 1);

            // artArraySetup(arrOrder, "linkStart");
            // arrOrder = arrOrder + 3;

            // textBox(arrOrder + 2);
            // artArraySetup(arrOrder + 1, "linkText");

            // arrOrder = arrOrder + 4;
            // linkI++;

        } else {
            $('#lnkMsg').text("Please place an Article Text first!");
        }
    }
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

$('#preBtn').on('click', function(e) {

    //$('#runOrd').text(e.target.innerHTML);
    var name = e.target.innerHTML;
    
    if( name.includes("Preview")){

        $('#preVwPnl').html(disArr());
        $('#preVwPnl').show("slow");
        e.target.innerHTML = "Close";
    } else if(name.includes("Close")) {
        $('#preVwPnl').slideUp();
        e.target.innerHTML = "Preview";
    }

  
  
});

$('#btnUndo a').on('click', function(){

    if(arrOrder > 6){

      removeLastElement(elmtArr[ielmt-1]);

    } else {
        $('#lnkMsg').text('Sorry there is nothing to undo');
    }

    
})

function trackElementCreation(elmtId){
    elmtArr[ielmt] = elmtId;

    ielmt++;

}

function removeLastElement(elmtId){

    var arrElmtNo = getElmtNo(elmtId); 
    var elmt = elmtId.substring(4); // this is repeated
                                    //may change to do once.

    clearArr(arrElmtNo);
    arrOrder = arrOrder - arrElmtNo;
    
    if(elmt.includes("Lnk")){
        if(elmtArr.indexOf(elmtId) > 0){

           var temp = elmtArr[elmtArr.indexOf(elmtId) - 1]; 
           var prvElmt = temp.substring(4);
    
           if(prvElmt.includes("Txt")){
               
               artArr[arrOrder - 1] = postTags("text");
           }
        }
    }

    if(arrElmtNo > 3){
        elmtArr[ielmt - 1] = "";
        elmtArr[ielmt - 2] = "";

        ielmt = ielmt - 2;

    } else {
        elmtArr[ielmt - 1] = "";

        ielmt = ielmt - 1;
    }
    
}

    function replaceTag(prvElmt){
        var temp = prvElmt.substring(0, 4);

        switch(temp){
            case "Txt":
                tag = postTag('text');
            break;
            case "MnPic":
                tag = postTag('imageMain');
            break;
            case "RtPic":
                tag = postTag('imageMain');
            break;
            case "LtPic":
                tag = postTag('imageMain');
            break;
        }

        return tag;
    }

    function getElmtNo(id){

        var temp = id.substring(4);

        switch(temp){
            case "Txt":
                num = 3;
            break;
            case "MnPic":
                num = 3;
            break;
            case "RtPic":
                num = 6;
            break;
            case "LtPic":
                num = 6;
            break;
            case "Lnk":
                num = lnkType(id);
        }

        return num;
    }

        function lnkType(id){

            var ind = arrElmtNo.indexOf(id);
            if(ind > 0){
                var previous = arrElmtNo[ind-1];

                if(id.substring(0, 4).includes("Txt")){
                    return 9;
                } else {
                    return 7;
                }

            } else {
                return 7;
            } 
        }

    function clearArr(forLn){

        for(var i = artArr.length-forLn; i<forLn; i++){
            artArr[i] = "";
        }
    }

function removePic(){
	
	if($('#headLnPicChkBx').is(':checked')){
		artArr[4] = "";
        artArr[5] = "";
        artArr[6] = "";

	} else {
        artArraySetup(4, "headLnPic");

        $('#headLnPicLbl').text("Title Picture");
    }
}

function imageType(choice){
    var pos = arrOrder + 1;

    switch(choice){
        case "Stand Alone":
            imageMain(pos, "MnPic");
            artArraySetup(arrOrder, "imageMain")
        break;
        case "Inline Right":
            imageMain(pos, "RtPic");
            artArraySetup(arrOrder, "imageRight") 
            arrOrder = arrOrder + 3;
            posT = arrOrder +1;
            textBox(posT);
            artArraySetup(arrOrder, "text") 
            artTxt++;
        break;
        case "Inline Left":
            imageMain(pos, "LtPic");
            arrOrder = arrOrder + 3;
            posT = arrOrder +1;
            textBox(posT);
            artArraySetup(arrOrder, "text");
            artTxt++;
        break;
    }

    arrOrder = arrOrder + 3;
    pic++;
}

function addHeadline(){
    artArr[arrOrder] = preTags('headLine');
    artArr[arrOrder+2] = postTags('headLine');
}

function addText(){

    textBox(arrOrder + 1);
	
    artArraySetup(arrOrder, "text")
  
    artTxt++;
	arrOrder = arrOrder + 3;
}

function textBox(pos2){
	var newTextBoxDiv = $(document.createElement('div'))
  .attr("id", 'art' + artTxt + 'Txt').attr("class", 'form-group');

  newTextBoxDiv.after().html(
    '<label class="control-label col-md-2" for="Art' + artTxt + 'Txt">Article Text ' + artTxt + '</label>' +
          '<div class="col-md-6">' +
            '<textarea class="form-control" id="Art' + artTxt + 'Txt" placeholder="Article Content here"' +
    'onchange="updateArr(this,'+ pos2 + ')"></textarea>' +
          '</div>');

  newTextBoxDiv.appendTo('#artPnl');
  trackElementCreation('Art' + artTxt + 'Txt');
}

function imageMain(pos2, idEnd){
	
	var newpicDiv = $(document.createElement('div'))
  .attr("id", 'art' + pic + idEnd).attr("class", 'form-group');

  newpicDiv.after().html(
  '<label class="control-label col-md-2" for="art' + pic + idEnd + '">Add Picture ' + pic + '</label>' +
          '<div class="col-md-6">' +
            '<input type="file" name="disPic" id="art' + pic + idEnd +'" class="form-control-file" onchange="updateArr(this,'+ pos2 + ')">'+
          '</div>');

  newpicDiv.appendTo('#artPnl');

   trackElementCreation('art' + pic + idEnd );
}

function link(pos2){
	
	var newLnkBxxDiv = $(document.createElement('div'))
  .attr("id", 'art' + linkI + 'Lnk').attr("class", 'form-group');

  newLnkBxxDiv.after().html(
    '<label class="control-label col-md-2" for="Art' + linkI + 'Lnk">Article Link ' + linkI + '</label>' +
          '<div class="col-md-6">' +
            '<input type="text" class="form-control" id="art' + linkI + 'UrlLnk" placeholder="Place URL for link here"' +
            'onchange="updateArr(this,'+ pos2 + ')">' +
            '<input type="text" class="form-control" id="art' + linkI + 'textLnk" placeholder="Place your text to display link here"' +
            'onchange="updateArr(this,'+ (pos2 + 2) + ')">' +
          '</div>');

  newLnkBxxDiv.appendTo('#artPnl');

  trackElementCreation('art' + linkI + 'Lnk');
}

function linkInline(){
    link(arrOrder);

    artArraySetup(arrOrder-1, "linkInline");
    arrOrder = arrOrder + 3;

    textBox(arrOrder+1);
    artArraySetup(arrOrder, "linkText");

    arrOrder = arrOrder + 3;
    linkI++;
}

function linkStart(){
    link(arrOrder + 1);

    artArraySetup(arrOrder, "linkStart");
    arrOrder = arrOrder + 3;

    textBox(arrOrder + 2);
    artArraySetup(arrOrder + 1, "linkText");

    arrOrder = arrOrder + 4;
    linkI++;
}

function artArraySetup( order, secType){
	
	pos1 = order;
	pos3 = order + 2;

	preTag = preTags(secType);
	postTag = postTags(secType);

	artArr[pos1] = preTag;
	artArr[pos3] = postTag;

}

function preTags(secType){

	switch(secType){

		case "text":
			txt = "<p>";
			break;
		case "imageMain":
			txt = '<img class="img-responsive col-xs-12 col-sm-10 col-md-10 col-lg-8 col-sm-offset-1 col-md-offset-1 col-lg-offset-2" atl="Main Article Img" scr="';
			break;
		case "imageLeft":
			txt = '<img  class="pull-left img-responsive col-md-8 col-lg-6" alt="pic2" src="';
			break;
		case "imageRight":
            txt = '<img  class="pull-right img-responsive col-md-8 col-lg-6" alt="pic2" src="'
			break;
		case "linkInline":
			txt = '<a href="';
			break;
		case "linkStart":
			txt = '<p><a href="';
			break;
		case "linkText":
			txt = '</a>';
			break;
		case "headLine":
			txt = `<div class="row">
                        <span class="bg-warning col-sm-offset-2 col-md-offset-2 col-lg-offset-3" style="font-size:500%;">`;
			break;
        case "headLnPic":
            txt = `<div class="row">
                        <image class="img-responsive col-xs-12 col-sm-10 col-md-10 col-lg-8 col-sm-offset-1 col-md-offset-1 col-lg-offset-2" alt="image1" src="`;
            break;
        case "headText":
            txt = `<div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                        <p>`;
            break;
	}   

	return txt;
}

function postTags(secType){

	switch(secType){

		case "text":
			txt = "</p>";
			break;
		case "imageMain":
			txt = '">';
			break;
		case "imageLeft":
			txt = '">';
			break;
		case "imageRight":
			txt = '">';
			break;
		case "linkInline":
			txt = '">';
			break;
		case "linkText":
			txt = "</p>";
			break;
		case "linkStart":
			txt = '">';
			break;
		case "headLine":
			txt = `</span>
                </div>
                <div id="mainContent">`;
			break;
        case "headLnPic":
            txt = `">
            </div>`;
            break;
        case "headText":
            txt = `</p>`;
            break;
	}

	return txt;
}

function updateArr(e,pos2){

    var id = e.id;

    if(id.includes("headLnPic")){

        if($('#headLnPicChkBx').is(':checked')){
            $('#headLnPicLbl').text("Title Picture - Please untick check-box to use");
        } else {
            artArr[pos2] = e.value;
        }

    } else {

        artArr[pos2] = e.value;

    } 

   $('#runOrd').text(disArr);
}

function disArr(){
  
    var contents = "";
  
    for (var index = 1; index < artArr.length; index++) {
        contents = contents + artArr[index];
    }

  
    return contents;
}