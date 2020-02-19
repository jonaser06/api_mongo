<?php

class Compacto extends Base
{
    
    public function index(){

        $string = "mongodb://3.20.122.140:27017";

        $collection = new MongoDB\Client($string);

        $companydb = $collection->companydb2;

        $result1 = $companydb->createCollection('testdesdephp');

        var_dump($result1);
        
        /* $this->ResponseJson($data); */ 
    }

    public function test(){

        $this->mongoTest();
        echo 'OK';
    }
}

?>