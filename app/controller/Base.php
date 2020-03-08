<?php

class Base
{
    public function ResponseJson($data = '', $message = 'Find One!'){

        header('Content-Type: application/json');
        $response = new stdClass();
        #validation
        if($data):
            $response->status = 'true';
            $response->message = $message;
            $response->data[0] = $data;
        else:
            $response->status = 'false';
            $response->message = 'this data is empty!';
            $response->data = '';
        endif;

        echo json_encode($response);
        exit;
    }

    public function toJson($data = '', $message = 'Find One!'){

        header('Content-Type: application/json');
        $response = new stdClass();
        #validation
        if($data):
            $response->status = 'true';
            $response->message = $message;
            $response->data = $data;
        else:
            $response->status = 'false';
            $response->message = 'this data is empty!';
            $response->data = '';
        endif;

        echo json_encode($response);
        exit;
    }

    public function mongoConnet(){

        $string = "mongodb://".MONGO_HOST.":".MONGO_PORT;

        $collection = new MongoDB\Client($string);

        return $collection;

    }

    public function memcached(){

        $mem = new Memcached();

        $mem->addServer(MONGO_HOST, 11211);

        return $mem;
    }

    public function autoIncrement($db, $collection){

        $client = $this->mongoConnet();

        $client = $client -> $db -> $collection;

        $count = $client->count();

        $id = 0;

        if($count == 0){
            return $count;
            
        }else{
            $client = $this->mongoConnet();
            $client = $client -> $db -> $collection;
            $getAll = $client->find();

            foreach($getAll as $categ){
                if($categ["cid"]> $id){
                    $id = $categ["cid"];
                }
            }
            return $id;
        }
    }
    
    public function insertCollection($data='', $db, $collection){
        $client = $this->mongoConnet();
        $client = $client->$db->$collection;
        $insert = $client->insertOne($data);
        $this->ResponseJson($data,'Inserted '.$insert->getInsertedCount().' document(s)!');

    }
}

?>