<?php
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->get('/test',function(){ 

    $compacto = new Compacto();
    $compacto->index(); 
    
});

$app->post('/api/generate_url',function(){ 

    $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());
    $title = $getbody->url;
    $compacto = new ServiceController();
    $compacto->generateUrl($title); 
    
});

$app->run();
?>