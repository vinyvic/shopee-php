<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class Wholesale extends RequestParameters 
{
    /**
     * Minimum count of this tier
     * @param int $value
     * @return $this
     */
    public function setMinCount(int $value) {
        $this->parameters["min_count"] = $value;
        return $this;
    }

    /**
     * Maximum count of this tier
     * @param int $value 
     * @return $this
     */
    public function setMaxCount(int $value) {
        $this->parameters["max_count"] = $value;
        return $this;
    }

    /**
     * Unit price of this tier
     * @param float $value 
     * @return $this
     */
    public function setUnitPrice(int $value) {
        $this->parameters["unit_price"] = $value;
        return $this;
    }
}
