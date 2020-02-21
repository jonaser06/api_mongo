<?php

require_once './vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$mem = new Memcached();
$mem->addServer(getenv('MONGO_HOST'), 11211);

$result = $mem->get("blah");

if ($result) {
    echo $result;
} else {
    echo "No matching key found.  I'll add that now!";
    $mem->set("blah", "I am data!  I am held in memcached!") or die("Couldn't save anything to memcached...");
}
?>