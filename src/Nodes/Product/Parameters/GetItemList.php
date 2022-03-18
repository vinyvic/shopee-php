<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class GetItemList extends RequestParameters
{
    /**
     * Specifies the starting entry of data to return in the current call. Default is 0. If data is more than one page,
     * this field needs to be replaced with "next_offset" to request,and the offset can be some entry to start next call.
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
     * The update_time_from and update_time_to fields specify a date range for retrieving orders (based on the item update time). 
     * The update_time_from field is the starting date range.
     *
     * @param string $timestamp
     * @return $this
     */
    public function setUpdateTimeFrom(int $timestamp)
    {
        $this->parameters['update_time_from'] = $timestamp;

        return $this;
    }

    /**
     * The update_time_from and update_time_to fields specify a date range for retrieving orders (based on the item update time). 
     * The update_time_to field is the ending date range
     *
     * @param string $timestamp
     * @return $this
     */
    public function setUpdateTimeTo(int $timestamp)
    {
        $this->parameters['update_time_to'] = $timestamp;

        return $this;
    }

    
    /**
     * NORMAL/BANNED/DELETED/UNLIST
     *
     * @param string $value
     * @return $this
     */
    public function setItemStatus(string $value)
    {
        $this->parameters['item_status'] = $value;

        return $this;
    }
}