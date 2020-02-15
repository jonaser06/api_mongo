<?php

$app->get('/cdn/:url',function($url){ 

    $compacto = new ServiceController();
    $compacto->imgCnd($url);
    
});
?>