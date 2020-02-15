<?php
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

/* $app->get('/test',function(){ 

    $compacto = new Compacto();
    $compacto->index(); 
    
}); */

$app->post('/generate_url/',function(){ 

    $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());
    $title = $getbody->url;
    $compacto = new ServiceController();
    $compacto->generateUrl($title); 
    
});

$app->post('/upload_image/',function(){ 

    $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());
    $title = $getbody->url;
    $compacto = new ServiceController();
    $compacto->generateImg($title);
    
});

$app->post('/tags',function(){ 

    return 'Hola Mundo';

    /* $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());
    $title = $getbody->url;
    $compacto = new ServiceController();
    $compacto->generateUrl($title);  */
    
});

#cdn
include 'cdn.php';

$app->run();
?>