<?php

namespace BeerApi\Controller\Api\Beer;

use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use Respect\Relational\Sql;

/**
* Controller for /api/beer/id
*/
class One implements Routable
{
    private $mapper;

    function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException(
                'Given $id isn\'t an valid integer'
            );
        }
        return $this->mapper->beers[$id]->breweries->fetch();
    }
}
