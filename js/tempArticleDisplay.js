function getArticleLocation(search, type){
    $.post(
        'services/article.php',
        {
            search : search,
            type : type
        },
        function(data){
            if(data.exist){
                return data.location
            }
        },
        'json'
    );
}
