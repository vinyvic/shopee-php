<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class UpdatePrice extends RequestParameters
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

    /**
     * Length should be between 1 to 50.
     *
     * @param array<PriceList> $value
     * @return $this
     */
    public function setPriceList(array $value)
    {
        $this->parameters['price_list'] = $value;

        return $this;
    }
}

class PriceList extends RequestParameters
{
    /**
     * 0 For no model item
     */
    public function setModelId(int $value)
    {
        $this->parameters['model_id'] = $value;
    }

    /**
     * Original price for this model (Required)
     */
    public function setOriginalPrice(int $value)
    {
        $this->parameters['original_price'] = $value;
    }
}