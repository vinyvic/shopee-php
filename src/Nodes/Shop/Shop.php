<?php

namespace Shopee\Nodes\Shop;

class Shop
{
    protected $path;

    public function __construct() {
        $this->path = '/api/v2/shop/';
    }

    /**
     * @param string|UriInterface $redirUri
     */
    public function getAuthorizationURL ($redirUri)
    {
        
    }
}
