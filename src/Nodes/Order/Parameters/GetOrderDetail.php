<?php

namespace Shopee\Nodes\Order\Parameters;

use Shopee\RequestParameters;

class GetOrderDetail extends RequestParameters
{
    /**
     * The set of order_sn. If there are multiple order_sn, you need to use English comma to connect them. limit [1,50]
     *
     * @param array<string> $value
     * @return $this
     */
    public function setOrderSnList(array $value)
    {
        $value = implode(',', $value);
        $this->parameters['order_sn_list'] = $value;

        return $this;
    }   
}