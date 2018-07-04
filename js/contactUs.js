$('#sbmtBtn').on('click', function(){
  
  subject = $('#subject').val();
  contactObj = $('#contDets');
  content = $('#msgTxtBx').val();
  store = true;
  
  subjectError = $('#subjtErr');
  contactError = $('#cntDtsErrLbl');
  contentError = $('#msgErr');
  
  subjectError.hide();
  contactError.hide();
  contentError.hide();
  
  if(subject.length < 1){
    subjectError.show();
    subjectError.css('color', '#E74C3C');
    subjectError.text('Please enter a Subject.');
    store = false;
  }
  
  if(contactObj.is('label')){
    
    contact = contactObj.text();
  } else {
     contact = contactObj.val();
  }
  
  if(contact.length < 1){
      contactError.show();
      contactError.css('color', '#E74C3C');
      contactError.text('Please enter a Email for contacting.');
      store = false;
    }
  
  if(content.length < 1){
    contentError.show();
    contentError.css('color', '#E74C3C');
    contentError.text('Please enter a content.');
    store = false;
  }
  
  if(store){
    storeMessage(subject, contact, content);
  }
});

function storeMessage(subject, contact, content){
  
  $.post(
       'service/contact.php',
        {
          subject : subject,
          contact : contact,
          content : content
        },
        function(data){
          if(data.status){
            message('success', 'Thank you for contactinh us, if a reply is warrented then please allow a few days for a responce please.');
            window.location = 'index.php';
          }else{
            $('#submitErr').css('color', '#E74C3C');
            $('#submitErr').text('Hmmm, thats not right. Please try again, if persists contact support@royalflush.online');
            
          }
        },
        'json'
  );
}

function message(type, text){
  
  $.post(
        'service/message.php',
        {
            message : 'Error logging out please try again',
            type : 'warning'
        },
        function(data){
        },
        'json'
    );
}
