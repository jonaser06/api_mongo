<?php
/* 
* Load Composer
*/
    require_once './vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    $test  =  "SERVER NAME: ".getenv('MONGO_HOST');
    $test .=  "PORT: ".getenv('MONGO_PORT');

    echo $test;
?>