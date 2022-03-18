<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class GetItemBaseInfo extends RequestParameters
{
    /**
     * item_id list; limit [0,50]
     *
     * @param array<int> $value
     * @return $this
     */
    public function setItemIdList(array $value)
    {
        $this->parameters['item_id_list'] = implode(',', $value);

        return $this;
    }

    /**
     * if true will response tax_info
     *
     * @param bool $value
     * @return $this
     */
    public function setNeedTaxInfo(bool $value)
    {
        $this->parameters['need_tax_info'] = $value;

        return $this;
    }

    /**
     * if true will response complaint_policy
     *
     * @param bool $value
     * @return $this
     */
    public function setNeedComplaintPolicy(bool $value)
    {
        $this->parameters['need_complaint_policy'] = $value;

        return $this;
    }
}