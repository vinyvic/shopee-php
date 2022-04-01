<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class ItemList extends RequestParameters 
{
    public function __construct() {
        $this->setUnlist(true);
    }

    /**
     * Shopee's unique identifier for an item (Required)
     *
     * @param int $value
     * @return $this
     */
    public function setItemId(int $value)
    {
        $this->parameters['item_id'] = $value;

        return $this;
    }

    /**
     * Unlist or not
     *
     * @param bool $value
     * @return $this
     */
    public function setUnlist(bool $value)
    {
        $this->parameters['unlist'] = $value;

        return $this;
    }
}