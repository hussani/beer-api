<?php

require_once __DIR__ . '/../bootstrap.php';

use Respect\Rest\Router;
use Respect\Relational\Sql;

$router = new Router();

$router->get('/api/beers/', function () use($mapper) {
    $page = (filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT)) ? $_GET['page'] : 1;
    $limit = (filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT)) ? $_GET['limit'] : 15;
    $offset = ($page - 1) * $limit;

    if (($offset < 0) || ($limit < 1)) {
        return setHttpErrors(400, "Bad Request");
    }

    return $mapper->beers->breweries->fetchAll(Sql::orderBy('beers.id')
        ->desc()->limit($offset, $limit));
});

$router->get('/api/beer/*', function ($id) use ($mapper){
    return $mapper->beers[$id]->breweries->fetch();
});

function setHttpErrors($number, $message)
{
    header('HTTP/1.1 '. $number . ' ' . $message);
    return array(
        'error' => array(
            'status' => $number,
            'message' => $message
        )
    );
}

$router->run();
