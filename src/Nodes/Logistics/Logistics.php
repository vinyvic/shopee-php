<?php

namespace Shopee\Nodes\Logistics;

use Shopee\Nodes\Node;
use Shopee\ResponseData;

class Logistics extends Node
{
    public function __construct($client) {
        parent::__construct($client, '/api/v2/logistics/');
    }

    public function shipOrder($parameters = []): ResponseData {
        return $this->post('ship_order', $parameters);
    }
}