<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class UpdateStock extends RequestParameters
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
     * @param array<StockList> $value
     * @return $this
     */
    public function setStockList(array $value)
    {
        $this->parameters['stock_list'] = $value;

        return $this;
    }
}

class StockList extends RequestParameters
{
    /**
     * 0 For no model item
     */
    public function setModelId(int $value)
    {
        $this->parameters['model_id'] = $value;
    }

    /**
     * Normal stock (Required)
     */
    public function setNormalStock(int $value)
    {
        $this->parameters['normal_stock'] = $value;
    }
}