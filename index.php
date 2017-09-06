<?php
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once ROOT . '/core/loader.php';
spl_autoload_register('Loader::go');

$router = new Router();
$router->run();
//Categories::addCategory('Планшет asus', '6', 'tablets-asus');
//require_once 'recurs.php';