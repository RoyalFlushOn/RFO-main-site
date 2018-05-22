
$(function(){
    $.post(
        'services/loginStatus.php',
        {
            request : 'status'
        },
        function(data){
            if(data.status != ''){
                loginNavBtnConfig(data.status);
            } else {
                loginNavBtnConfig();
            } 
        },
        'json'
    )
});

$('#logout a').on('click', function(){

    $.post(
        'services/loginStatus.php',
        {
            request : 'logout'
        },
        function(data){
            if(data.status == 'success'){
                loginNavBtnConfig(data.status);
            } else {
                logoutErrorMsg();
            }
        },
        'json'
    )

});

function logoutErrorMsg(){

    $.post(
        'service/message.php',
        {
            message : 'Error logging out please try again',
            type : 'warning'
        },
        function(data){
            if(data.completed){
                location.reload();
            } else {
                window.location = 'index.php';
            }
        },
        'json'
    )
}


function loginNavBtnConfig(status){
    
    switch(status){
        case 'login':
            $("#logout a").show();
            $("#login a").hide(); 
            $("#reg a").hide();
            break;
        case 'registation':
            $("#logout a").show();
            $("#login a").hide();
            $("#reg a").hide();
            break;
        default:
            $("#logout a").hide();
            $("#login a").show();
            $("#reg a").show();
            break;
    }


}