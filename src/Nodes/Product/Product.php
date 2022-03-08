<?php

namespace Shopee\Nodes\Product;

use Shopee\Nodes\Node;
use Shopee\ResponseData;

class Product extends Node
{
    public function __construct($client) {
        parent::__construct($client, '/api/v2/product/');
    }

    /**
     * Use this call to get a list of items.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function getItemsList($parameters = []): ResponseData
    {
        return $this->get('get_item_list', $parameters);
    }


    /**
     * Use this call to get a list of items.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function addItem($parameters = []): ResponseData
    {
        return $this->post('add_item', $parameters);
    }
}