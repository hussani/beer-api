<?php

namespace BeerApi\Controller\Api\Beer;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use Respect\Relational\Sql;

/**
* Controller for /api/beers
*/
class All implements Routable
{
    private $mapper;

    function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get($limit = 10, $offset = 0)
    {

        if (($offset < 0)) {
            throw new \InvalidArgumentException(
                'Variable $offset must be a integer greater than zero. Given '. 
                    $offset
            );
        }
        if ($limit < 1) {
            throw new \InvalidArgumentException(
                'Variable $limit must be a integer greater than zero. Given ' . 
                    $limit
            );
        }

        return $this->mapper->beers->breweries->fetchAll(Sql::orderBy('beers.id')
            ->desc()->limit($offset, $limit));
    }
}
