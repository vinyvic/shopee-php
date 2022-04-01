<?php

namespace Shopee\Nodes\Logistics\Parameters;

use Shopee\RequestParameters;

class GetTrackingNumber extends RequestParameters
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

    /**
     * Shopee's unique identifier for the package under an order. 
     * You should't fill the field with empty string when there isn't a package number.
     *
     * @param string $value
     * @return $this
     */
    public function setPackageNumber(string $value)
    {
        $this->parameters['package_number'] = $value;

        return $this;
    }

    /**
     * Shopee's unique identifier for the package under an order. 
     * You should't fill the field with empty string when there isn't a package number.
     *
     * @param string $value
     * @return $this
     */
    public function setResponseOptionalFields(string $value)
    {
        $this->parameters['response_optional_fields'] = $value;

        return $this;
    }
}