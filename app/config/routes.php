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

    if($_FILES['image']['name']):
        $temp = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        $name = explode(".",$name);
        $name = $name[0];
        $compacto = new ServiceController();
        $compacto->generateImg($name, $temp);
    else:
        echo '404: No selecciono ninguna imagen.';
        exit;
    endif;    
});

$app->post('/tags',function(){ 

    return 'Hola Mundo';

    /* $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());
    $title = $getbody->url;
    $compacto = new ServiceController();
    $compacto->generateUrl($title);  */
    
});

$app->post('/categorias',function(){ 

});
#cdn
include 'cdn.php';

$app->run();
?>