<?php
class Compacto extends Base implements iTemplate
{   
    public static $param = DEV_DATABASE;
    public static $compacto = 'Compacto';
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
                self::$create = 0;
                # if exist, we insert to collection
                $this->insertCollection($data, self::$param, self::$compacto);
                break;
            endif;
        }

        if($create):

            $db = $client->$param;

            #if not exist, create to collection
            $collection = $db->createCollection(self::$compacto);

            # insert to collection
            $this->insertCollection($data, self::$param, self::$compacto);

        endif;
    }
    public function get(){
        $db = self::$param;
        $nameCollection = self::$compacto;
        $response = [];
        $data = [];

        $client = $this->mongoConnet();
        $colleccion = $client->$db->nameCollection;

        $cursor = $collection->find();
        foreach($cursor as $document){
           
            $response = [
                "cid"           => $categ["cid"]
                
            ];
            array_push($data,$response);
        }

        $this->toJson($data);
        
    }
    public function del(){

    }
    public function update(){

    }
    public function test(){

        $client = $this->mongoTest();

        foreach ($client->listDatabases() as $databaseInfo) {
            echo $databaseInfo->getName().'<br>';
        }
    }
}

?>