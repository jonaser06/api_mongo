<?php

class Compacto extends Base implements iTemplate
{
    public function set(){

    }
    public function get(){
        
    }
    public function del(){

    }

    public function test(){

        $client = $this->mongoTest();

        foreach ($client->listDatabases() as $databaseInfo) {
            echo $databaseInfo->getName().'<br>';
        }
    }
}

?>