<?php
class Categorias extends Base implements iTemplate
{   
    public function set(){

        echo 'test';
        exit;

        /* $client = $this->mongoTest();
        foreach ($client->listDatabases() as $databaseInfo) {
            if($databaseInfo->getName() == $database):
                return 'Ya existe la BD en Mongo';
            else:
                return 'Se creo '. $database . ' con exito';
            endif;
        } */

    }
    public function get(){

    }
    public function del(){

    }
    
    public function test(){
        echo 'Hola desde categorias controller';
    }
}
?>