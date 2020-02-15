<?php
/* 
* Load Composer
*/
    /* require_once './vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    $test  =  "SERVER NAME: ".getenv('MONGO_HOST');
    $test .=  "PORT: ".getenv('MONGO_PORT');

    echo $test; */
    echo 'getimagesize(): '.function_exists (getimagesize());
    echo 'imagecreatetruecolor(): '.function_exists (imagecreatetruecolor());
    echo 'imagecreatefromjpeg(): '.function_exists (imagecreatefromjpeg());
    echo 'imagecopyresized(): '.function_exists (imagecopyresized());
    echo 'imagejpeg(): '.function_exists (imagejpeg());
?>