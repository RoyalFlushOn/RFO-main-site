<?php
    require_once '../appClass/Autoloader.php';
    $json = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/private/paths.json');
    $jsonObj = json_decode($json);
    $articlePath = $jsonObj->articles;
    $criteria = $column = $noOfResults = $val = ' ';
    $results = array();


    if(!empty($_POST['type'])){
        if(!empty($_POST['search'])){
            
            switch($_POST['type']){

                case 'id':
                    $column = 'article_id';
                    $criteria = $_POST['search'];
                break;
                case 'Headline':
                    $column = 'headline';
                    $criteria = $_POST['search'];
                break;
                case 'Author':
                    $column = 'author';
                    $criteria = $_POST['search'];
                break;
                case 'Summary':
                    $column = 'tagline';
                    $criteria = $_POST['search'];
                break;
                case 'Tags':
                    $column = 'tag';
                    $temp = $_POST['search'];
                    $criteria = '(';
                    foreach ($temp as $value) {
                        $criteria += $value . ',';
                    }
                    chop($criteria, ',');
                    $criteria += ')';
                break;
            }

        

            if($column != 'tag'){
                $dtAcc = new DataAccess();

                $temp = $dtAcc->returnQuery("Select article_id, author, file_name, headline From Articles where " . 
                                            $column . " like '%" . $criteria . "%'");
                
            }else{
                $dtAcc = new DataAccess();

                $temp = $dtAcc->returnQuery('Select article_id, author, is_validated, file_name From Articles where ' . 
                                            $column . "in " . $criteria . " and is_validated = 'Y' ");
            }
            
            if($temp != null ){

                $article = $temp->fetchAll(PDO::FETCH_ASSOC);
                $i = 0;

                if(is_array($article)){
                    if(count($article) > 0){
                        $responce->location = $_SERVER['DOCUMENT_ROOT']. '/'. $articlePath->validated;
                        $responce->exist = true;
                        $responce->results = $article;
                        $responce->found = count($article);
                    } else {
                        $responce->exist = false;
                    }
                    
                } else {
                    $responce->exist = false;
                }
                
            } else {

                $responce->exist = false;
            }

            echo json_encode($responce);
            // var_dump($val);
        }
    }
    
?>
