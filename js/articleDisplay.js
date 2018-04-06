function getArticleContent(id){

    articleLocation = getLocation(id);
    $('#articleContent').load(articleLocation);
}

function search(){
    $('#articleContent').load('plugins/articleSearch.php');
}