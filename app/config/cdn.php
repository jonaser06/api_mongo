<?php

$app->get('/media/get-image/:url',function($url){ 

    $compacto = new ServiceController();
    $compacto->imgCnd($url);
    
});
?>