<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Respect\Rest\Router;

$router = new Router();

$router->get('/', function(){
	echo "hello world";
});