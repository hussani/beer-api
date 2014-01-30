<?php

require_once __DIR__ . '/vendor/autoload.php';

use Respect\Config\Container;
use Respect\Relational\Mapper;

$env = getEnvironment();

$container = new Container(__DIR__ . "/config/database.ini");

$database = $container->$env;

$mapper = new Mapper(
    new PDO($database['dsn'], $database['user'], $database['pass'])
);

function getEnvironment()
{
    if (isset($_SERVER['SERVER_SOFTWARE']) &&
        (substr_count($_SERVER['SERVER_SOFTWARE'], 'Google App Engine') > 0)) {
        return 'appengine';
    }
    return 'dev';
}