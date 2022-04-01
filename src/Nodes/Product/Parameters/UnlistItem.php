<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class UnlistItem extends RequestParameters
{
    /**
     * Length should be between 1 to 50 (Required)
     *
     * @param array<ItemList> $value
     * @return $this
     */
    public function setItemList(array $value)
    {
        $this->parameters['item_list'] = $value;

        return $this;
    }
}