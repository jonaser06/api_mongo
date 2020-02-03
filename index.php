<?php
ini_set('date.timezone', 'America/Lima');
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

    /* 
    * Load Composer
    */
    require_once './vendor/autoload.php';

    /* 
    * Load Config DB
    */
    require_once './app/config/db.php';

    /* 
    * Load Controller
    */
    require_once './app/controller/Base.php';
    require_once './app/controller/CompactoController.php';

    /* 
    * Load Routes
    */
    require_once './app/config/routes.php';

    
?>