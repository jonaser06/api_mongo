<?php

class Compacto extends Base
{
    
    public function index(){

        $string = "mongodb://3.20.122.140:27017";

        $collection = new MongoDB\Client($string);

        $companydb = $collection->companydb;

        $result1 = $companydb->createCollection('testdesdephp2');

        var_dump($result1);
        
        /* $this->ResponseJson($data); */ 
    }
}

?>