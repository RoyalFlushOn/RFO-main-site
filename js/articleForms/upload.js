$('#hdLnErr').text(hdLnErr);
$('#thmbErr').text(thmbErr);
$('#tagErr').text(tagErr);
$('#artConErr').text(artConErr);
$('#upldFrmErr').text(upldFrmErr);

let active;

$('#errorFooterPnl').hide();
$('#articleThumbnailPnl').hide();
$('#articleThumbnailFile').hide();
$('#articleThumbnailUrl').hide();
$('#closeChoiceBtn').hide();

let quill = new Quill('#articleEditor', { theme: 'snow' });

function articleImgcheck(e){
    //  var fileNm = $('#file').val();
    var fileNm = e.value;

     console.log(fileNm);

    if(!fileNm.includes('.jpg')){
        if(!fileNm.includes('.gif')){
            if(!fileNm.includes('.png')){
                // $('#artFileErr').css('color', '#E74C3C');
                $('#thmbErr').text('File must be an image file with extention; png, jpg, gif, please upload another');

                e.files = null;
            }
            
        }
             

    }
}

function articleImageUrlCheck(e){
   let url = e.value;
  
    console.log(url.match(/^(https:\/\/www\.|https:\/\/)/g));
}

$('#artThmbFileBtn').on('click', function(){
    $('#artTmbChoice').val('file');
    $('#articleThumbnailFile').show();
    $('#articleThumbnailPnl').show();
    active = 'articleThumbnailFile';
    $('#articleThumbnailChoiceBtns').hide();
    $('#articleThumbnailSubLbl').text('');
    $('#formatLbl').text('File:');
    $('#closeChoiceBtn').show();
});

$('#artThmbURLBtn').on('click', function(){
    $('#artTmbChoice').val('url');
    $('#articleThumbnailUrl').show();
    $('#articleThumbnailPnl').show();
      active = 'articleThumbnailUrl';
    $('#articleThumbnailChoiceBtns').hide();
  $('#articleThumbnailSubLbl').text('');
    $('#formatLbl').text('Url:');
    $('#closeChoiceBtn').show();
});

function closeTumbnailChoice(){
  $('#' + active).hide();
  $('#articleThumbnailPnl').hide();
  $('#articleThumbnailSubLbl').text('Format');
  $('#articleThumbnailChoiceBtns').show();
  $('#closeChoiceBtn').hide();
  $('#formatLbl').text('');
  $('#artTmbChoice').val('');
}


$('#articleSubmitBtn').on('click', function(){
  let content = JSON.stringify(quill.getContents());
  $('#articleContent').val(content);
  
  $('#articleForm').submit();
});




