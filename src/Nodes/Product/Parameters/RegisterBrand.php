<?php
namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class RegisterBrand extends RequestParameters
{
    /**
     * Brand name, length<=254.
     *
     * @param string $value
     * @return $this
     */
    public function setOriginalBrandName(string $value)
    {
        $this->parameters['original_brand_name'] = $value;

        return $this;
    }

    /**
     * Brand name, length<=254.
     *
     * @param array<int> $value
     * @return $this
     */
    public function setCategoryList(array $value)
    {
        $this->parameters['category_list'] = $value;

        return $this;
    }

    /**
     * Brand name, length<=254.
     *
     * @param string $value
     * @return $this
     */
    public function setBrandCountry(string $value)
    {
        $this->parameters['brand_country'] = $value;

        return $this;
    }
}