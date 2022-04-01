<?php

namespace Shopee\Nodes\Logistics\Parameters;

use Shopee\RequestParameters;

class GetShippingParameter extends RequestParameters
{
    /**
     * Shopee's unique identifier for an order.
     *
     * @param string $value
     * @return $this
     */
    public function setOrderSn(string $value)
    {
        $this->parameters['order_sn'] = $value;

        return $this;
    }   
}