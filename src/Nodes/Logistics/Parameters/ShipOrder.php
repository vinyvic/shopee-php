<?php

namespace Shopee\Nodes\Logistics\Parameters;

use Shopee\RequestParameters;

/**
 * Use this api to initiate logistics including arrange pickup, dropoff or shipment for non-integrated logistic channels.
 * Should call v2.logistics.get_shipping_parameter to fetch all required param first. 
 * It's recommended to initiate logistics one hour after the orders were placed since there is one-hour window buyer can cancel any order without request to seller.
 */

class ShipOrder extends RequestParameters
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
     * Shopee's unique identifier for an order.
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
     * Required parameter ONLY if get_shipping_parameter returns "pickup" under "info_needed". Developer should still include "pickup" field in the call even if "pickup" has empty value.
     *
     * @param int $address_id           The identity of address. Retrieved from v2.logistics.get_shipping_parameter.
     * @param string $pickup_time_id    The pickup time id. Retrieved from v2.logistics.get_shipping_parameter.
     * @param string $tracking_number   Need input this field when "tracking_number" is returned from "info_need". Please note that this tracking number is assigned by third-party shipping carrier for item shipment.
     * @return $this
     */
    public function setPickup (int $address_id, string $pickup_time_id, string $tracking_number){
        $value = [
            "address_id"        => $address_id,
            "pickup_time_id"    => $pickup_time_id,
            "tracking_number"   => $tracking_number,
        ];

        $this->parameters['pickup'] = $value;

        return $this;
    }

    /**
     * Required parameter ONLY if get_shipping_parameter returns "dropoff" under "info_needed". 
     * Developer should still include "dropoff" field in the call even if "dropoff" has empty value. 
     * For logistic_id 80003 and 80004, both Regular and JOB shipping methods are supported.
     * If you choose Regular shipping method, please use "tracking_no" to call Init API. 
     * If you choose JOB shipping method, please use "sender_real_name" to call Init API.
     * Note that only one of "tracking_no" and "sender_real_name" can be selected.
     *
     * @param int $branch_id            The identity of branch.
     * @param string $sender_real_name  The real name of sender.
     * @param string $tracking_number   Need input this field when "tracking_number" is returned from "info_need". Please note that this tracking number is assigned by third-party shipping carrier for item shipment.
     * @param string $slug              The selected 3PL partner to drop-off parcels with.
     * @return $this
     */
    public function setDropoff (int $branch_id, string $sender_real_name, string $tracking_number, string $slug){
        $value = [
            "branch_id"         => $branch_id,
            "sender_real_name"  => $sender_real_name,
            "tracking_number"   => $tracking_number,
            "slug"              => $slug
        ];

        $this->parameters['dropoff'] = $value;

        return $this;
    }

    /**
     * Optional parameter when get_shipping_parameter returns "non-integrated" under "info_needed".
     *
     * @param int $tracking_number      Optional parameter for non-integrated channel order. The tracking number assigned by the shipping carrier for item shipment.
     * @return $this
     */
    public function setNonIntegrated (int $tracking_number){
        $value = [
            "tracking_number"  => $tracking_number,
        ];

        $this->parameters['non_integrated'] = $value;

        return $this;
    }
}