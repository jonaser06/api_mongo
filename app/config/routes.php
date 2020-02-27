<?php
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();


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
    
});

$app->post('/compacto/',function(){
    $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());
    $categoria = new Compacto;
    $categoria->set($getbody);
});

$app->post('/categorias/',function(){

    $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());

    $param = DEV_DATABASE;
    $category = 'Categorias';

    $cid = new Base();
    $cid = $cid->autoIncrement($param, $category) + 1;

    
    if( isset($getbody->status) && isset($getbody->descripcion) && isset($getbody->titulo) && isset($getbody->url) ): 
        $data = [
            "cid"           => $cid,
            "status"        => $getbody->status,
            "descripcion"   => $getbody->descripcion,
            "titulo"        => $getbody->titulo,
            "url"           => $getbody->url
        ];
    endif;

    $categoria = new Categorias;
    $categoria->set($data);
});

$app->post('/categorias/delete/:id',function($id){
    $categoria = new Categorias;
    $categoria->del((int)$id);
});

$app->get('/categorias',function(){ 
    $compacto = new Categorias();
    $compacto->get(); 
});
#cdn
include 'cdn.php';

$app->run();
?>