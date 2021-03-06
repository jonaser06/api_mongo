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
                self::$create = 0;
                # if exist, we insert to collection
                $this->insertCollection($data, self::$param, self::$category);
                break;
            endif;
        }

        if($create):

            $db = $client->$param;

            #if not exist, create to collection
            $collection = $db->createCollection(self::$category);

            # insert to collection
            $this->insertCollection($data, self::$param, self::$category);

        endif;

    }

    /**
     * Display a listing of the resource.
     * @template of interface\templateInterface
     * @param 
     */
    public function get(){
        $db = self::$param;
        $collection = self::$category;
        $response = [];
        $data = [];

        $client = $this->mongoConnet();
        $client = $client->$db->$collection;

        $getAll = $client->find();
        header('Content-Type: application/json');
        foreach($getAll as $categ){
            $response = [
                "cid"           => $categ["cid"],
                "status"        => $categ["status"],
                "descripcion"   => $categ["descripcion"],
                "titulo"        => $categ["titulo"],
                "url"           => $categ["url"]
            ];
            array_push($data,$response);
        }
        
        $this->toJson($data);
    }

    /**
     * Display a listing of the resource.
     * @template of interface\templateInterface
     * @param 
     */
    public function del($id = ''){

        $db = self::$param;
        $collection = self::$category;

        $client = $this->mongoConnet();
        $client = $client->$db->$collection;
        $deleteResult = $client->deleteOne(['cid' => $id]);
       
        if($deleteResult->getDeletedCount() == 0):
            $this->toJson(' ','No se encontro Categoria');
           else:
            $this->toJson(' ','Categoria Eliminada');
           endif;
        
    }
    
    
    public function update($id = '' ,$data = ''){
            
        $db = self::$param;
        $collection = self::$category;
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
}
?>