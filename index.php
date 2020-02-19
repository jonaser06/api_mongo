<?php
header('Access-Control-Allow-Origin:*'); 
header('Access-Control-Allow-Headers:X-Request-With');

header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

ini_set('date.timezone', 'America/Lima');
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

/* 
* Load Composer
*/
require_once './vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

define('MONGO_HOST', getenv('MONGO_HOST') );
define('MONGO_PORT', getenv('MONGO_PORT') );

/* 
* Load Config DB
*/
require_once './app/config/db.php';

/* 
* Load Controller
*/
require_once './app/controller/Base.php';
require_once './app/controller/CompactoController.php';
require_once './app/controller/ServiceController.php';

/* 
* Load Routes
*/
require_once './app/config/routes.php';

    
?>