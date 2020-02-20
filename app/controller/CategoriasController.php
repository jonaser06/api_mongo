<?php
class Categorias extends Base implements iTemplate
{   
    public function set($data = ''){
        $param = 'devBFC';

        $create = true;

        $client = $this->mongoTest();
        
        foreach ($client->listDatabases() as $databaseInfo) {
            if( $databaseInfo->getName() == $param ):
                $create = false;

                # if exist, we insert to collection
                $this->insertCollection($data);

                break;
            endif;
        }

        if($create):

            $db = $client->$param;

            #if not exist, create to collection
            $collection = $db->createCollection('Categorias');

            # insert to collection
            $this->insertCollection($data);

        endif;

    }

    public function get(){

    }
    public function del(){

    }

    public function test(){
        echo 'Hola GET categorias';
    }

    public function insertCollection($data){

        $param = 'devBFC';
        $category = 'Categorias';
        $client = $this->mongoTest();
        $client = $client->$param->$category;

        $insert = $client->insertOne($data);

        printf("Inserted %d document(s)\n", $insert->getInsertedCount());
    }
}
?>