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
     * Use this call to get categories.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function getCategory($parameters = []): ResponseData
    {
        return $this->get('get_category', $parameters);
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
     * Use this call to Add a new item.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function addItem($parameters = []): ResponseData
    {
        return $this->post('add_item', $parameters);
    }

    /**
     * Use this call to get a list of brand.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function getBrandList($parameters = []): ResponseData
    {
        return $this->get('get_brand_list', $parameters);
    }

    /**
     * Use this api to get basic info of item by item_id list.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function getItemBaseInfo($parameters = []): ResponseData
    {
        return $this->get('get_item_base_info', $parameters);
    }


    /**
     * Use this call to delete a product item.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function deleteItem($parameters = []): ResponseData
    {
        return $this->post('delete_item', $parameters);
    }

}