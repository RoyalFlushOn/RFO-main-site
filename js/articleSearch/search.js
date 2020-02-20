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

    // searchDropDownButton.text(searchCriteria);
    searchDropDownButton.html(searchCriteria + ' <span class="caret"></span>');

    $(this).preventDefault();
});

$("#srchBtn").on("click", function(){
    errorLabel.hide();
    searchText = searchTextbox.val();

    console.log('Search value is: ' + searchText + ' and search type is: ' + searchCriteria);

    if(searchText === ""){
        errorMsg('please enter text, before searching');
    } else {
        getArticle(searchText, searchCriteria);
    }

});

searchResultsClose.on('click', function(){
    resultsTable.hide();
    searchRow.show();
    resultsTableBody.empty();
});

function errorMsg(msg){
    errorLabel.show();
    errorLabel.css("color", "#E74C3C");
    errorLabel.text(msg)
    searchTextbox.text(searchText);
    // searchDropDownButton.text(searchCriteria);
    searchDropDownButton.html(searchCriteria + ' <span class="caret"></span>');

}