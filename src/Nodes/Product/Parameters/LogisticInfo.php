<?php
namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class LogisticInfo extends RequestParameters
{
    /**
     * ID of the channel (Required)
     *
     * @param int $logisticId
     * @return $this
     */
    public function setLogisticId(int $logisticId)
    {
        $this->parameters['logistic_id'] = $logisticId;

        return $this;
    }

    /**
     * Whether channel is enabled for this item (Required)
     *
     * @param bool $enabled
     * @return $this
     */
    public function setEnabled(bool $enabled)
    {
        $this->parameters['enabled'] = $enabled;

        return $this;
    }

    /**
     * Shipping fee, Only needed when logistics fee_type = CUSTOM_PRICE.
     *
     * @param float $shippingFee
     * @return $this
     */
    public function setShippingFee(float $shippingFee)
    {
        $this->parameters['shipping_fee'] = $shippingFee;

        return $this;
    }

    /**
     * Size ID, If specify logistic fee_type is SIZE_SELECTION size_id is required.
     *
     * @param int $sizeId
     * @return $this
     */
    public function setSizeId(int $sizeId)
    {
        $this->parameters['size_id'] = $sizeId;

        return $this;
    }

    /**
     * Whether cover shipping fee for buyer
     * Default value is False.
     *
     * @param bool $isFree
     * @return $this
     */
    public function setIsFree(bool $isFree = false)
    {
        $this->parameters['is_free'] = $isFree;

        return $this;
    }
}