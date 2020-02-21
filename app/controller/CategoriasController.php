<?php
class Categorias extends Base implements iTemplate
{   
    public static $param = DEV_DATABASE;
    public static $category = 'Categorias';
    public static $create = true;


    /**
     * Display a listing of the resource.
     * @template of interface\templateInterface
     * @param $data String param
     */
    public function set($data = ''){

        $client = $this->mongoConnet();

        foreach ($client->listDatabases() as $databaseInfo) {
            if( $databaseInfo->getName() == self::$param ):
                self::$create = false;
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

    /**
     * Display a listing of the resource.
     * @template of interface\templateInterface
     * @param 
     */
    public function get(){

    }

    /**
     * Display a listing of the resource.
     * @template of interface\templateInterface
     * @param 
     */
    public function del(){

    }

    /**
     * Display a listing of the resource.
     * @template of interface\templateInterface
     * @param 
     */
    public function test(){
        echo 'Hola GET categorias';
    }

    public function insertCollection($data){

        $db = self::$param;
        $collection = self::$category;

        $client = $this->mongoConnet();
        $client = $client->$db->$collection;
        $insert = $client->insertOne($data);

        $this->ResponseJson($data,'Inserted '.$insert->getInsertedCount().' document(s)!');

    }
}
?>