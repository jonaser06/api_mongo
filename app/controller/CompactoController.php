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
    public function get($page=1){
        $nameCollection = self::$compacto;
        $db         = self::$param;
        $response   = [];
        $data       = [];

        
        $client     = $this->mongoConnet();
        $collection = $client->$db->$nameCollection;

        #formulando consulta
        $total      = $collection->count();
        $forPage    = 5;
        $pagination = ceil($total/$forPage);
        $current   = ((int)$page-1)*$forPage;

        $query   = [];
        $options = ['limit' => $forPage, 'sort'=>['cid' => -1], 'skip'=>$current];

        if($page <= $pagination):
            $cursor = $collection->find($query, $options);
            header('Content-Type: application/json');
    
    
            foreach($cursor as $document){
               
                $response = [
                    "cid"           => $document["cid"],
                    "titulo"        => $document["titulo"],
                    "titulo_seo"    => $document["titulo_seo"],
                    "bajada"        => $document["bajada"],
                    "url"           => $document["url"],
                    "contenido"     => $document["contenido"],
                    "categoria"     => $document["categoria"],
                    "img"           => $document["img"],
                    "video"         => $document["video"],
                    "publicidad"    => $document["publicidad"],
                    "fecha"         => $document["fecha"],
                    "tags"          => $document["tags"],
                    "tipo"          => $document["tipo"]
                ];
                array_push($data,$response);
            }

            #controls
            $next_page    = ( (int)$page + 1 ) <= ( $pagination ) ? ( (int)$page + 1 ) : false;
            $previus_page = ( (int)$page - 1 ) <= 0 ? false : ( (int)$page - 1 ) ;
    
            $this->toJson($data, null, $next_page, $previus_page, $page);
        else:
            $this->toJson();
        endif;
    }

    public function getid($id = ''){
        $db = self::$param;
        $nameCollection = self::$compacto;
        $response = [];
        $data = [];

        $query = ['cid' => $id];
        $options = ['sort' => ['timestamp' => 1]];

        $client = $this->mongoConnet();
        $collection = $client->$db->$nameCollection;

        $cursor = $collection->find($query, $options);
        header('Content-Type: application/json');

        foreach($cursor as $document){
           
            $response = [
                "cid"           => $document["cid"],
                "titulo"        => $document["titulo"],
                "titulo_seo"    => $document["titulo_seo"],
                "bajada"        => $document["bajada"],
                "url"           => $document["url"],
                "contenido"     => $document["contenido"],
                "categoria"     => $document["categoria"],
                "img"           => $document["img"],
                "video"         => $document["video"],
                "publicidad"    => $document["publicidad"],
                "fecha"         => $document["fecha"],
                "tags"          => $document["tags"],
                "tipo"          => $document["tipo"]
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
         header('Content-Type: application/json');

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