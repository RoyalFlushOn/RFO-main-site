var searchCriteria = 'Headline';
var searchText;
var articles = Array();
var result;

function getArticleContent(id){

    getArticleLocation(id, "id");
    if(result != null){
        displayArticle();
    } else {
        notfound();
    }
    
}

function displayArticle(){
    

    if(result != null){
        if(result.found == 1){
            temp = result.results;
            articles[0] = result.location + '/'+ temp['autor'] + '/' + temp['article_id'];
            loadArticle(0);
        } else if(result.found > 1){
            i = 0;
            $.each(result.results, function(key, val){
                resultsTableBody.append("<tr>");
                resultsTableBody.append('<td>' + val['headline'] + '</td>');
                resultsTableBody.append('<td>' + val['author'] + '</td>');
                resultsTableBody.append('<td><button class="btn btn-success" onclick=("loadArticle(' + i + '))" type="button">View</button></td>');
                resultsTableBody.append("</tr>");
                i++;
            });
            searchRow.hide();
            resultsTable.show();
        }
    } else {
        notfound();
    }
    
}

function loadArticle(index){

    //$("#articleContent").load(articles[index]);
    $('#srchErrLbl').text(articles[index]);
    $('#srchErrLbl').show();
}

function search(){
    $("#articleContent").load("plugins/articleSearch.php");

    $.getScript("js/articleSearch/search.js").fail(function(){
        $('#scptErrLbl').text('Ooops!! Search feature has failed, please refresh. Also fingers crossed.');
    })

}

function getArticleLocation(search, type){
    $.post(
        "services/article.php",
        {
            search : search,
            type : type
        },
        function(data){
            if(data.exist){
                result = data;
            } else {
                result = null;
            }
        },
        "json"
    );
}

// function notfound(){
//     errorLabel.css("color", "#E74C3C");
//     errorLabel.text("No results found!!")
//     searchTextbox.text(searchText);
//     searchDropDownButton.text(searchCriteria);
// }