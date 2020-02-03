<?php

class Compacto extends Base
{
    public function index(){

        $string = "mongodb://192.168.1.8:27017";

        $collection = new MongoDB\Client($string);

        $companydb = $collection->companydb;

        $result1 = $companydb->createCollection('test');

        var_dump($result1);
        
        /* $this->ResponseJson($data); */
    }
}

?>