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

    #cast object to array
    $array   = (array)$getbody;

    #define db y collection
    $param = DEV_DATABASE;
    $collection = 'Compacto';
    
    #primary key
    $cid = new Base();
    $cid = $cid->autoIncrement($param, $collection) + 1;
    $cid = array("cid"=>$cid);

    #merged arrays
    $array = $cid + $array;

    #insert to mongo
    $categoria = new Compacto;
    $categoria->set($array);
    
    
});

$app->post('/categorias/',function(){

    $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());

    $param = DEV_DATABASE;
    $category = 'Categorias';

    $cid = new Base();
    $cid = $cid->autoIncrement($param, $category) + 1;

    
    if( isset($getbody->descripcion) && isset($getbody->titulo) && isset($getbody->url) ): 
        $data = [
            "cid"           => $cid,
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

$app->post('/compacto/delete/:id',function($id){
    $compacto = new Compacto;
    $compacto->del((int)$id);
});

#PUT

$app->put('compacto/update/:id', function($id,$data){

    $request = \Slim\Slim::getInstance()->request();
    $getbody = json_decode($request->getBody());

    $compacto = new Compacto;
    $compacto->update((int)$id ,$data);
});

$app->put('/categorias/update/:id',function($id){
    
    $request = \Slim\Slim::getInstance()->request();
    $getbody = (array)json_decode($request->getBody());

    $categoria = new Categorias;
    $categoria->update((int)$id,$getbody); 
});

#GET
$app->get('/categorias',function(){ 
    $categoria = new Categorias();
    $categoria->get(); 
});

$app->get('/compacto',function(){
    if(isset($_GET['page'])):
        $page = (int)$_GET['page'];
    else:
        $page = (int)1;
    endif;
    $compacto = new Compacto();
    $compacto->get($page); 
});

$app->get('/compacto/:id',function($id){ 
    $compacto = new Compacto();
    $compacto->getid((int)$id); 
});

#cdn
include 'cdn.php';

$app->run();
?>