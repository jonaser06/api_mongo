<?php

class Compacto extends Base implements iTemplate
{
    public function set(){

    }
    public function get(){
        
    }
    public function del(){

    }
    
    public function index(){

        $string = "mongodb://3.20.122.140:27017";

        $collection = new MongoDB\Client($string);

        $companydb = $collection->companydb2;

        $result1 = $companydb->createCollection('testdesdephp');

        var_dump($result1);
        
        /* $this->ResponseJson($data); */ 
    }

    public function test(){

        $client = $this->mongoTest();

        foreach ($client->listDatabases() as $databaseInfo) {
            echo $databaseInfo->getName().'<br>';
        }
    }
}

?>