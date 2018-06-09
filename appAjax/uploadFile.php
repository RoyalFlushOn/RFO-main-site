<?php

include '../appClass/Autoloader.php';

$log = new Logger();
$responce = '';
$image = false;


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $responce = 'only post worked';

    $log->startLog();
    $log->logEntry('Post request present');
    $path = subStr(__DIR__, 0,strlen(__DIR__) - strlen('/appAjax')) . $_POST['path'];
    $log->logEntry('Path set to ' . $path);
    
    if(!empty($_POST['image'])){
        $image = $_POST['image']; 
    }

    $log->logEntry('Image flag set to ' . $image);

    if(!is_dir($path)){
        $log->logEntry('Dir doesnt exist, creating directory to $path');
        mkdir($path);
        $log->logEntry('Dir created');
    }

    // if(!empty($_POST['file'])){
    //     $content = $_POST['file'];
    //     $log->logEntry('Article string present, starting saving process.');
    //     if(file_exists($path . '/'. $_POST['name'])){
    //         $log->logEntry('File already exists, closing process.');
    //         $log->endLog();
    //         $responce = 'exists';
    //     } else {
    //         $file = fopen($path . '/'. $_POST['name'], 'w');
    //         $log->logEntry('File at path,  '. $path . '/'. $_POST['name']. ' is created and opened for writing to.');
    //         fwrite($file, $content);
    //         $log->logEntry('Data written to file');
    //         fclose($file);
    //         $log->logEntry('File closed and saved.');
    //         $log->endLog();
    //         $responce = 'article success';
            
    //     }
    // } else {
    //     $log->logEntry('Posted data not present in file param.');
    //     $log->endLog();
    //     $responce = 'file empty';
    // }

    if($image != false ){
        $log->logEntry('Image saving process started');
        if(isset($_FILES['file'])){
            if(getimagesize($_FILES['file']['tmp_name'])){
                $log->logEntry('File is a valid image');
                if(move_uploaded_file($_FILES['file']['tmp_name'], $path. '/' . $_FILES['file']['name'])){
                    $log->logEntry('File uploaded successfully');
                    $log->endLog();
                    $responce =  $path. '/' . $_FILES['file']['name'];
                } else {
                    $log->logEntry('File upload failed');
                    $log->endLog();
                    $responce = 'image fail';
                }
            } else {
                $log->logEntry('File not a vaild image, uploading aborted.');
                $log->endLog();
                $responce = 'invalid image';
            }
        } else {
            $log->logEntry('File not set, process stopped.');
            $log->endLog();
            $responce ='file fail';
        }
    }
}

    // if(isset($_FILES['file'])){
    //     $log->logEntry('Files are set');
    //     if($image){
    //         if(getimagesize($_FILES['file']['tmp_name'])){
    //             $log->logEntry('File is a valid image');
    //             if(move_uploaded_file($_FILES['file']['tmp_name'], $path. '/' . $_FILES['file']['name'])){
    //                 $log->logEntry('File uploaded successfully');
    //                 $log->endLog();
    //                 echo $_FILES['file']['name'];
    //             } else {
    //                 $log->logEntry('File upload failed');
    //                 $log->endLog();
    //                 echo 'fail';
    //             }
    //         } else {
    //             $log->logEntry('File not a vaild image, uploading aborted.');
    //             $log->endLog();
    //             echo 'image fail';
    //         }
    //     } else {
    //         if(move_uploaded_file($_FILES['file']['tmp_name'], $path. '/' . $_FILES['file']['name'])){
    //                 $log->logEntry('File uploaded successfully');
    //                 $log->endLog();
    //                 echo $_FILES['file']['name'];
    //             } else {
    //                 $log->logEntry('File upload failed');
    //                 $log->endLog();
    //                 echo 'fail';
    //             }
    //     }


    echo $responce;
?>