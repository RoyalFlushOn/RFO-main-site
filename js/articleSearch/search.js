var searchTextbox = $("#srchTxtBx");
var searchDropDownButton = $("#srchOptDrpDwnBtn");
var errorLabel = $("#srchErrLbl");
var searchDropDown = $("#srchOptDrpDwn li a");
var resultsTable = $('#rsltTbl');
var resultsTableBody = $('#rsltTBdy');
var searchRow = $('#srchRow');
var searchResultsClose = $('#srchClsBtn');

resultsTable.hide();

searchDropDownButton.on("click", function(){
    event.preventDefault();
}); 

searchDropDown.on("click", function(){

    searchCriteria = $(this).text();

    searchDropDownButton.text(searchCriteria);

    $(this).preventDefault();
});

$("#srchBtn").on("click", function(){
    errorLabel.hide();
    searchText = searchTextbox.val();

    getArticleLocation(searchText, searchCriteria);
    if(result != null){
        displayArticle();
    } else {
        notfound();
    }
    

});

searchResultsClose.on('click', function(){
    resultsTable.hide();
    searchRow.show();
    resultsTableBody.empty();
    result = null;
});

function notfound(){
    errorLabel.show();
    errorLabel.css("color", "#E74C3C");
    errorLabel.text("No results found!!")
    searchTextbox.text(searchText);
    searchDropDownButton.text(searchCriteria);

}