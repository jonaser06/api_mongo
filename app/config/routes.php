<?php
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->get('/',function(){ 

    $compacto = new Compacto();
    $compacto->index(); 
    
});


$app->run();
?>