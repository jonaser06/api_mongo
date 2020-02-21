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

    public function mongoConnet(){

        $string = "mongodb://".MONGO_HOST.":".MONGO_PORT;

        $collection = new MongoDB\Client($string);

        return $collection;

    }

    public function autoIncrement($db, $collection){

        $client = $this->mongoConnet();

        $client = $client -> $db -> $collection;

        $count = $client->count();

        return $count;


    }
}

?>