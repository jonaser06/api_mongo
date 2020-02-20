<?php
class Categorias extends Base implements iTemplate
{   
    public function set($param = ''){

        $create = true;

        $client = $this->mongoTest();
        
        foreach ($client->listDatabases() as $databaseInfo) {
            if( $databaseInfo->getName() == $param ):
                $create = false;
                echo 'Ya existe';
                break;
            endif;
        }
        if($create){
            echo 'Creado';
            $db = $client->$param;
            $result1 = $db->createCollection('testdesdephp');
        }
    }
    public function get(){

    }
    public function del(){

    }

    public function test(){
        echo 'Hola GET categorias';
    }
}
?>