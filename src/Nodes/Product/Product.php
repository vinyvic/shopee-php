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
     * Use this call to register a brand.
     *
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function registerBrand($parameters = []): ResponseData
    {
        return $this->get('register_brand', $parameters);
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

    /**
     * You can change the tier structure through this api. For example, if you only define color, it is one tier. 
     * If you define color and size, it is two tier. 
     * This API can change no tier to one tier, no tier to two tier, one tier to two tier, two tier to one tier.
     * We support two tier structures at most.
     * 
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function initTierVariation($parameters = []): ResponseData
    {
        return $this->post('init_tier_variation', $parameters);
    }

    /**
     * Use this call to search item.
     * 
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function searchItem($parameters = []): ResponseData
    {
        return $this->get('search_item', $parameters);
    }

    /**
     * Update item.
     * 
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function updateItem($parameters = []): ResponseData
    {
        return $this->post('update_item', $parameters);
    }

    /**
     * Update stock.

     * 
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function updateStock($parameters = []): ResponseData
    {
        return $this->post('update_stock', $parameters);
    }

    /**
     * Update Price.

     * 
     * @param array|Parameters\GetItemsList $parameters
     * @return ResponseData
     */
    public function updatePrice($parameters = []): ResponseData
    {
        return $this->post('update_price', $parameters);
    }
}