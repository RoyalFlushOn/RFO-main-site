var searchCriteria = 'Headline';
var searchText;
let quill;
var articles = Array();

$.ready(getArticleContent());



/**
 * Takes in a id and passes to the getArticleLoaction, currently called
 * during page load if id found in as url param.
 * @param {String} id 
 */
function getArticleContent(){
  
  console.log("starting check")
  
  let queryString = window.location.search
  if(queryString === ''){
    search();
  } else {
    queryString = queryString.substr(1)
    let firstSplit = queryString.split('&');
    let finalSplit = firstSplit[0].split('=');

     if(finalSplit[0] === 'id'){
       let regex = /^[0-9a-zA-Z]+$/;
       let id = encodeURI(finalSplit[1]);

       if(id.match(regex)){
         
         getArticle(id, "id");
         
       } else {
         search();
       }

     }
   }

   
    
}

function setupQuill(){
  quill = new Quill('#articleContent')
  quill.enable(false);
}

/**
 * Takes plain object and displays its contence based on how may items are in the
 * results attribute. The results are either displayed as a table if there are
 * more than one or the article its self is displayed if there is only one result.
 * @param {Object} result 
 */
// function displayArticle(result){
    

//     if(result != null){
//         if(result.found == 1){
//             temp = result.results[0];
//             articles[0] = result.location + '/'+ temp.author + '/' + temp.article_id + '/' + temp.file_name;
//             loadArticle(0, false);
//         } else if(result.found > 1){
//             i = 0;
//             $.each(result.results, function(key, val){
//                 resultsTableBody.append("<tr>");
//                 resultsTableBody.append('<td>' + val['headline'] + '</td>');
//                 resultsTableBody.append('<td>' + val['author'] + '</td>');
//                 resultsTableBody.append('<td><button class="btn btn-success" onclick="loadArticle(' + i + ')" type="button">View</button></td>');
//                 resultsTableBody.append("</tr>");

//                 articles[i] = result.location + '/'+ val['author'] + '/' + val['article_id'] + '/' + val['file_name'];

//                 i++;
//             });
//             searchRow.hide();
//             resultsTable.show();
//         }
//     } else {
//         errorMsg('No results returned for this search criteria');
//     }
    
// }

function checkResults(result){
    
  console.log('did we even get here');
    if(result != null){
        if(result.found == 1){
          let article = result.results[0]
          displayArticle(article.content);
        } else if(result.found > 1){
            i = 0;
            $.each(result.results, function(key, val){
                resultsTableBody.append("<tr>");
                resultsTableBody.append('<td>' + val.headline + '</td>');
                resultsTableBody.append('<td>' + val.author + '</td>');
                resultsTableBody.append('<td><button class="btn btn-success" onclick="displaySerchArticle(' + i + ')" type="button">View</button></td>');
                resultsTableBody.append("</tr>");

                articles[i] = val.content;

                i++;
            });
            searchRow.hide();
            resultsTable.show();
        }
    } else {
        errorMsg('No results returned for this search criteria');
    }
    
}

/**
 * loads the search plugin when called, also loads the script to come with the search
 * plugin.
 */
function search(){
    $("#articleContent").load("plugins/articleSearch.php", function(responseTxt, statusTxt, xhr){
        if(statusTxt == 'error'){
            console.log('article search plugin failed');
            console.log(xhr.status + ': ' + xhr.statusText);
        } else if(statusTxt == 'success'){
            console.log('article search plugin loaded');
        }
        
    });
    

    $.getScript("js/articleSearch/search.js").fail(function(){
        $('#scptErrLbl').text('Ooops!! Search feature has failed, please refresh. Also fingers crossed.');
    });

}

/**
 * Posts the arguments to the search script on the server to return a json data
 * based on those arguments
 * @param {String} search 
 * @param {String} type 
 */
function getArticle(search, type){

    console.log('Passed into getArticleLocation function');
    console.log('The passed in search :' + search);
    console.log('The passed in type :' + type);

    $.post(
        "services/article.php",
        {
            search : search,
            type : type
        },
        function(data){
            console.log("checking the data returned")
            if(data.exists){
              console.log("article found now processing");
              checkResults(data);
            } else {
              console.log("Issue with logic");
                errorMsg('No results returned for this search criteria');
              //todo design to catch errors for article id's from url that dont match.
            }
        },
        "json"
    );
}

function displaySerchArticle(index){
  let article = articles[index];
  
  displayArticle(article);
}

function displayArticle(content){
  setupQuill();
  quill.setContents(JSON.parse(content));
}


// function loadArticle(index, tableResults){
    
//     $("#articleContent").load(articles[index], function(responseTxt, statusTxt, xhr){
//         if(statusTxt == 'error'){
//             console.log('hmmm there was no article to get');
//             console.log(xhr.status + ': ' + xhr.statusText);

//             msg = "There has been a problem with getting the requested article. Please try again and if problem persists, contact us on errors@royalflush.online";
//             $.post(
//                 "services/message.php",
//                 {
//                     message : msg,
//                     type : 'info'
//                 },
//                 function(data){
//                     if(data.status){
//                         console.log('message was a success, hoping to redirect');
//                         window.location = 'index.php';
//                     } else {
//                         console.log('message didnt work due to : ' + data.errorMsg);
//                         $("#articleContent").html('<p class="warning">' + msg + '</p>');
//                     }
//                 },
//                 'json'
//             )

//         } else if(statusTxt == 'success'){
//             console.log('article found and loaded');
//         }
//     });
//     if(tableResults){
//         resultsTable.hide();
//         resultsTableBody.empty();
//     }    
// }