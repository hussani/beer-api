<?php

require_once __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;


$router = new Router();

$router->get('/', function () use($mapper) {
    echo "hello world";
});

$router->run();
