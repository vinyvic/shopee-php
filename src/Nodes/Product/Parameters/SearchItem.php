<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class SearchItem extends RequestParameters
{
    /**
     * Specifies the starting entry of data to return in the current call. Default is empty. 
     * if data is more than one page, the offset can be some entry to start next call.
     *
     * @param int $value
     * @return $this
     */
    public function setOffset(int $value)
    {
        $this->parameters['offset'] = $value;

        return $this;
    }

    /**
     * the size of one page
     *
     * @param int $value
     * @return $this
     */
    public function setPageSize(int $value)
    {
        $this->parameters['page_size'] = $value;

        return $this;
    }

    /**
     * name of item.
     *
     * @param string $value
     * @return $this
     */
    public function setItemName(string $value)
    {
        $this->parameters['item_name'] = $value;

        return $this;
    }

    
    /**
     * 1:get item lack of requires attribute. 
     * 2:get item lack of optional attribute.
     *
     * @param int $value
     * @return $this
     */
    public function setAttributeStatus(int $value)
    {
        $this->parameters['attribute_status'] = $value;

        return $this;
    }
}