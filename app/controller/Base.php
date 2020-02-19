<?php

class Base
{
    public function ResponseJson($data = ''){

        header('Content-Type: application/json');
        $response = new stdClass();
        #validation
        if($data):
            $response->status = 'true';
            $response->message = 'Find One!';
            $response->data[0] = $data;
        else:
            $response->status = 'false';
            $response->message = 'this data is empty!';
            $response->data = '';
        endif;

        echo json_encode($response);
        exit;
    }

    public function mongoTest(){

        $string = "mongodb://".MONGO_HOST.":".MONGO_PORT;

        $collection = new MongoDB\Client($string);

        return $collection;

        /* $companydb = $collection->companydb2;

        var_dump($companydb) */;

        /* $result1 = $companydb->createCollection('testdesdephp'); */
    }
}

?>