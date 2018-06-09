
function articleFilecheck(e){
    //  var fileNm = $('#file').val();
    var fileNm = e.value;

     console.log(fileNm);

    if(!fileNm.includes('.txt')){
        if(!fileNm.includes('.html')){
            // $('#artFileErr').css('color', '#E74C3C');
            $('#artFlErr').text('File Must have .txt, .html file extention, please upload another');

            e.files = null;
        }
             

    }
}

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




// function uploadArticle(){
//      var fileNm = $('#artFile').val();

//      console.log(fileNm);

//     if(!fileNm.includes('.txt')){
//         $('#artFileErr').css('color', '#E74C3C');
//         $('#artFileErr').text('File Must have .txt file extention, please upload another');

//         this.files = null;     

//     } else {
//         $('#artFileErr').text('');

//         console.log('file is .txt');

//         var files = $('#artFile').prop('files');
//         // var text = null;
//         var reader = new FileReader();

//         console.log('file are' + files);

//         reader.onload = function(){
//             text = reader.result;
//             $('#artText').val(text);
//              $('#artFileUpload').show();
//         };
//         reader.readAsText(files[0]); 
    
//     }


// }

// function imgPost(){

//      var fileNm = $('#thmbFile').val();

//     if(!fileNm.includes('.png')){
//         $('#thmbErr').css('color', '#E74C3C');
//         $('#thmbErr').text('File Must have .jpg, .png or .gif file extention, please upload another');

//         $('#thmbFile').prop('files')[0] = null;     

//     } else {
//         $('#thmbErr').text('');

//         var files = $('#thmbFile').prop('files');
        
//         postFile(
//             'images/articles/testUser/AR1010', 
//             true, 
//             files[0].name,
//             files[0] 
//         );
    
//     }
// }

// function postFile(path, img, name, file){

//     var formData = new FormData();

//     formData.append('file', file);
//     formData.append('path', path);
//     formData.append('img', img);
//     formData.append('name', name);
    
//     $.ajax({
//         url: 'appAjax/uploadFile.php',
//         type: 'POST',
//         data: formData,
//         cache: false,
//         dataType: 'txt/plain',
//         processData: false, // Don't process the files
//         contentType: false, // Set content type to false as jQuery will tell the server its a query string request
//         success: function(data){
//              $('#artFileErr').css('color', '#E74C3C');
//              $('#artFileErr').text(data); 
//         }
//     });
    
    
//     // $.post("appAjax/uploadFile.php",
//     //             {
//     //                 path : path,
//     //                 image : img,
//     //                 name: name,
//     //                 file : file
//     //             },
//     //             function(result){

//     //                     $('#artFileErr').css('color', '#E74C3C');
//     //                     $('#artFileErr').text(result);                    

//     //                 // switch(result){
//     //                 //     case 'exists':
//     //                 //         $('#artFileErr').css('color', '#E74C3C');
//     //                 //         $('#artFileErr').text('Article already exists, please upload another');
//     //                 //     break;
//     //                 //     case 'article success':
//     //                 //         $('#artFile').hide();
//     //                 //         $('#artFileUpload').show(); 
//     //                 //     break;
//     //                 //     case 'file empty':
//     //                 //         $('#artFileErr').css('color', '#E74C3C');
//     //                 //         $('#artFileErr').text('problem with file content, please check and upload again');
//     //                 //     break;
//     //                 // }
//     //                 // if(result.includes('fail')){
//     //                 //     $('#artFileErr').css('color', '#E74C3C');
//     //                 //     $('#artFileErr').text('File failed, please try again');
//     //                 // }
//     //             });
// }

// // // Catch the form submit and upload the files
// // function uploadFiles(event)
// // {
// //   event.stopPropagation(); // Stop stuff happening
// //     event.preventDefault(); // Totally stop stuff happening

// //     // START A LOADING SPINNER HERE

// //     // Create a formdata object and add the files
// //     var data = new FormData();
// //     $.each(files, function(key, value)
// //     {
// //         data.append(key, value);
// //     });

// //     $.ajax({
// //         url: 'submit.php?files',
// //         type: 'POST',
// //         data: data,
// //         cache: false,
// //         dataType: 'json',
// //         processData: false, // Don't process the files
// //         contentType: false, // Set content type to false as jQuery will tell the server its a query string request
// //         success: function(data, textStatus, jqXHR)
// //         {
// //             if(typeof data.error === 'undefined')
// //             {
// //                 // Success so call function to process the form
// //                 submitForm(event, data);
// //             }
// //             else
// //             {
// //                 // Handle errors here
// //                 console.log('ERRORS: ' + data.error);
// //             }
// //         },
// //         error: function(jqXHR, textStatus, errorThrown)
// //         {
// //             // Handle errors here
// //             console.log('ERRORS: ' + textStatus);
// //             // STOP LOADING SPINNER
// //         }
// //     });
// // }

// // $('#artFile').on('change', function(event){
// //     var fileNm = $(this).val();

// //     if(!fileNm.includes('.html')){
// //         $('#artFileErr').css('color', '#E74C3C');
// //         $('#artFileErr').text('File Must have .html file extention, please upload another');

// //         $(this).files[0] = null;     
// //     } else {
// //         $('#artFileErr').text('');

// //         var files = this.files[0];

// //         $.post("appAjax/uploadFile.php",
// //                 {
// //                     path : '/article-files/unvalidated',
// //                     image : false,
// //                     file : files
// //                 },
// //                 function(result){
// //                     if(result.includes('fail')){
// //                  $('#artFileErr').css('color', '#E74C3C');
// //                         $('#artFileErr').text('File Must have .html file extention, please upload another');
// //                     } else {
// //                         $('#artFileErr').css('color', '#00bc8c');
// //                         $('#artFileErr').text('File ' + result + ' sucess, cheers');
// //                     }
// //                 });
// //     }
// // });