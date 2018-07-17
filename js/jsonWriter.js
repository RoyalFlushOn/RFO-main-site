class JsonWriter{

    startJson = `{"articleEditing":{
	                "elements": [`;
    middleJson = `],
	            "Article": {`;
    endJson = '} }';
    element;
    article;
    jsonString;

    constructor(){
        this.jsonString.concat(startJson);
    }

    addElement(elementType, content){

        this.jsonString.concat(elementStart(elementType));

        for( var item in content){
            this.jsonString.concat('"' + item + '",');
        }

        this.jsonString.concat(']');
    }

        elementStart(type){

            switch(type){
                case "Text":
                    str = `{ 
                            "entry": "3", 
                            "type": "Text",
                            "contentCount": "1", 
                            "content": [`;
                break;
                case "Head line":
                    str = `{ 
                            "entry": "1", 
                            "type": "Head Line",
                            "contentCount": "1", 
                            "content": [`;
                break;
            }
        }

    addArticle(articleContent){
        this.article.concat(articleContent);
    }

    completeArticle(){

       return this.jsonString.concat(middleJson, article, endJson);

    }



}
