<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class DeleteItem extends RequestParameters
{
    /**
     * Item ID (Required)
     *
     * @param int $value
     * @return $this
     */
    public function setItemId(int $value)
    {
        $this->parameters['item_id'] = $value;

        return $this;
    }
}