

$(function(){
    $.post(
        'services/loginStatus.php',
        {
            request : 'status'
        },
        function(data){
            loginNavBtnConfig(data.status);
        },
        'json'
    )
});

function locationUpdate(location){

    if(location.includes('login')){
        i = temp.lastIndexOf('/');
        location = location.substring(0, i+1);
    }
        $.post(
            'services/loginStatus.php',
            {
                request : 'location',
                location : location
            },
            function(data, success){
                if(success == "success"){
                }
            },
            'json'
        );
}



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


function logout(){
    $.post(
        'services/loginStatus.php',
        {
            request : 'logout'
        },
        function(data){
            loginNavBtnConfig(data.status);
            location.reload();
        },
        'json'
    );
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
            locationUpdate(page);
            break;
    }


}