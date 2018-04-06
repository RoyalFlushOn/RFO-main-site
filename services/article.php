<?php
    require_once('appClass/Autoloader.php');

    $criteria = $column = $jsonReponce = ' ';
    $results = $responce = array();

    if(!empty($_POST['type'])){
        if(!empty($_POST['search']))

        switch($_POST['type']){

            case 'id':
                $column = 'article_id';
                $criteria = $_POST['search'];
            break;
            case 'headline':
                $column = 'headline';
                $criteria = $_POST['search'];
            break;
            case 'tag':
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

            $temp = $dtAcc->returnQuery(`Select article_Location
                                            From Article
                                            where` . $column . "= '" . $criteria . "'");
            
        }else{
            $dtAcc = new DataAccess();

            $temp = $dtAcc->returnQuery(`Select article_Location
                                            From Article
                                            where` . $column . "in " . $criteria);
        }
        
        if($temp != null ){

            $temp->setFetchMode(PDO::FETCH_ASSOC);
            $article = $temp->fetchAll();

            if(is_array($article)){
                foreach ($article as $value) {
                    array_push($results, $value['id']=>$value['article_location']);                    
                }
            }
        }
        
        array_push($responce, "exist"=>true);
        

        
    }
?>
