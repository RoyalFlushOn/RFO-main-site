<?php

    include '../appClass/Autoloader.php';

    // $log = new Logger();

    // $log->startLog();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // $log->logEntry('Post method present, containing: ' . $_POST['response']);

        $response = $_POST['response'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $secret = '6LeEhiMUAAAAAIphWxeF9zTCfReCWUyhGxGvb6yj';

        // $log->logEntry('Variables Set; response, url, secret ');

        $postParas = array('secret' => $secret, 'response' => $response);

        // $log->logEntry('post params set as an array');

        $opts = array( 'http' =>
                        array(
                            'method'=> 'POST',
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'content' => http_build_query($postParas)
                        )
                    );
        
        // $log->logEntry('the rest of the post request is set; method, header and content');

        // $log->endLog();
        $conext = stream_context_create($opts);
        
        echo file_get_contents($url, false, $conext);

        // $check = new HttpRequest($url, HttpRequest::METH_POST);
        // $check->postFields(array('secret' => $secret, 'responce' => $responce));

        // try{
        //     echo $check->send()->getBody();
        // }
        // catch(HttpException $ex){

        //     echo $ex->getMessage();

        // }
    }

?>