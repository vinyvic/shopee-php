<?php

namespace Shopee\Nodes\Order;

use Shopee\Nodes\Node;
use Shopee\ResponseData;

class Order extends Node
{
    public function __construct($client) {
        parent::__construct($client, '/api/v2/order/');
    }

    public function getOrderList($parameters = []): ResponseData {
        return $this->get('get_order_list', $parameters);
    }

    public function getOrderDetail($parameters = []): ResponseData {
        return $this->get('get_order_detail', $parameters);
    }
}