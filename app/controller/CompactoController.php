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
        $collection = $client->$db->$nameCollection;

        $cursor = $collection->find();
        header('Content-Type: application/json');

        foreach($cursor as $document){
           
            $response = [
                "cid"           => $document["cid"],
                "titulo"        => $document["titulo"]
            ];
            array_push($data,$response);
        }

        $this->toJson($data);
        
    }
    public function del($id = ''){
        $db = self::$param;
        $collection = self::$compacto;

        $client = $this->mongoConnet();
        $client = $client->$db->$collection;
        $deleteResult = $client->deleteOne(['cid' => $id]);
       
        if($deleteResult->getDeletedCount() == 0):
            $this->toJson(' ','No se encontro nota');
           else:
            $this->toJson(' ','nota Eliminada');
           endif;

    }
    public function update($id = '' ,$data = ''){
         
         $db = self::$param;
         $collection = self::$compacto;
 
         $client = $this->mongoConnet();
         $client = $client->$db->$collection;
         $updateResult = $client->updateOne(['cid' => $id],['$set'=>$data]);
          
         $matches = $updateResult->getMatchedCount();
         $numModified = $updateResult->getModifiedCount();

             if($matches == 0):
              $this->toJson(' ',$matches.' Coincidencias');
             else:
              $this->toJson(' ','Modificaciones: '.$numModified.' & Coincidencias: '.$matches);
             endif;
        
    }
    public function test(){

        $client = $this->mongoTest();

        foreach ($client->listDatabases() as $databaseInfo) {
            echo $databaseInfo->getName().'<br>';
        }
    }
}

?>