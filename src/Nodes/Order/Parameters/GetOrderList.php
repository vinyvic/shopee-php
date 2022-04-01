<?php

namespace Shopee\Nodes\Order\Parameters;

use Shopee\RequestParameters;

class GetOrderList extends RequestParameters
{
    /**
     * The kind of time_from and time_to. Available value: create_time, update_time.
     *
     * @param string $value
     * @return $this
     */
    public function setTimeRangeField(string $value)
    {
        $this->parameters['time_range_field'] = $value;

        return $this;
    }

    /**
     * The time_from and time_to fields specify a date range for retrieving orders (based on the time_range_field). The time_from field is the starting date range. 
     * The maximum date range that may be specified with the time_from and time_to fields is 15 days.
     *
     * @param int $value
     * @return $this
     */
    public function setTimeFrom(int $value)
    {
        $this->parameters['time_from'] = $value;

        return $this;
    }

    /**
     * The time_from and time_to fields specify a date range for retrieving orders (based on the time_range_field). The time_from field is the starting date range. 
     * The maximum date range that may be specified with the time_from and time_to fields is 15 days.
     *
     * @param int $value
     * @return $this
     */
    public function setTimeTo(int $value)
    {
        $this->parameters['time_to'] = $value;

        return $this;
    }
    
    /**
     * Each result set is returned as a page of entries. Use the "page_size" filters to control the maximum number of entries to retrieve per page (i.e., per call). 
     * This integer value is used to specify the maximum number of entries to return in a single "page" of data.The limit of page_size if between 1 and 100.
     *
     * @param int $value
     * @return $this
     */
    public function setPageSize(int $value)
    {
        $this->parameters['page_size'] = $value;

        return $this;
    }

    public function setCurso(string $value)
    {
        $this->parameters['cursor'] = $value;

        return $this;
    }

    /**
     * Specifies the starting entry of data to return in the current call. Default is "". If data is more than one page, the offset can be some entry to start next call.
     *
     * @param string $value
     * @return $this
     */
    public function setCursor(string $value)
    {
        $this->parameters['cursor'] = $value;

        return $this;
    }

    /**
     * The order_status filter for retriveing orders and each one only every request. Available value: UNPAID/READY_TO_SHIP/PROCESSED/SHIPPED/COMPLETED/IN_CANCEL/CANCELLED/INVOICE_PENDING
     *
     * @param string $value
     * @return $this
     */
    public function setOrderStatus(string $value)
    {
        $this->parameters['order_status'] = $value;

        return $this;
    }
    
    /**
     * The order_status filter for retriveing orders and each one only every request. Available value: UNPAID/READY_TO_SHIP/PROCESSED/SHIPPED/COMPLETED/IN_CANCEL/CANCELLED/INVOICE_PENDING
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