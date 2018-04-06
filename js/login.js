function loginNavBtnConfig(status){
    if( status == 'default'){
        $("#logout a").hide();
        $("#login a").show();
        $("#reg a").show()
    } else if( status == 'logged'){
        $("#logout a").show();
        $("#login a").hide(); 
        $("#reg a").hide();
    } else if(status == 'registration'){
        $("#logout a").show();
        $("#login a").hide();
        $("#reg a").hide();
    }
}