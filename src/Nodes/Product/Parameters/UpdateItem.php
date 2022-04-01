<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class UpdateItem extends RequestParameters
{
    /**
     * Item ID (Required)
     *
     * @param int $value
     * @return $this
     */
    public function setItemId(int $value)
    {
        $this->parameters['item_id'] = $value;

        return $this;
    }

    /**
     * Item description
     * if description_type is normal , Description information should be set by this field.
     *
     * @param string $value 
     * @return $this
     */
    public function setDescription(string $value)
    {
        $this->parameters['description'] = $value;

        return $this;
    }

    /**
     * Weight of item
     *
     * @param float $value
     * @return $this
     */
    public function setWeight(float $value)
    {
        $this->parameters['weight'] = $value;

        return $this;
    }

    /**
     * Item name (Required)
     *
     * @param float $value
     * @return $this
     */
    public function setItemName(string $value)
    {
        $this->parameters['item_name'] = $value;

        return $this;
    }

    /**
     * Item status, could be UNLIST or NORMAL
     * 
     * @param string $value
     * @return $this
     */
    public function setItemStatus(string $value)
    {
        $this->parameters['item_status'] = $value;

        return $this;
    }

    /**
     * Item dimension
     * 
     * @param int $height
     * @param int $length
     * @param int $width
     * @return $this
     */
    public function setDimension(int $height, int $length, int $width)
    {
        $this->parameters['dimension'] = [
            "package_height" => $height,
            "package_length" => $length,
            "package_width"  => $width
        ];

        return $this;
    }

    /**
     * Item stock (Required)
     * 
     * @param int $value
     * @return $this
     */
    public function setNormalStock(int $value)
    {
        $this->parameters['normal_stock'] = $value;

        return $this;
    }

    /**
     * Logistic channel setting (Required)
     * 
     * @param array<LogisticInfo> $logisticInfo
     * @return $this
     */
    public function setLogisticInfo(array $logisticInfo)
    {

        $this->parameters['logistic_info'] = $logisticInfo;

        return $this;
    }

    /**
     * Item Attribute List
     * This field is optional(expect Indonesia) depending on the specific attribute under different categories. Should call shopee.item.GetAttributes to get attribute first. Must contain all all mandatory attribute.
     * 
     * @param array<AttributeList> $attributeList
     * @return $this
     */
    public function setAttributeList(array $attributeList)
    {
        $this->parameters['attribute_list'] = $attributeList;

        return $this;
    }

    /**
     * ID of category (Required)
     * 
     * @param int $value
     * @return $this
     */
    public function setCategoryId(int $value)
    {
        $this->parameters['category_id'] = $value;

        return $this;
    }

    /**
     * Item images (Required)
     * 
     * @param array<string> $imageIdList A list with ID's of image
     * @return $this
     */
    public function setImage(array $imageIdList)
    {
        $this->parameters['image']["image_id_list"] = $imageIdList;

        return $this;
    }

    /**
     * Pre order setting
     * 
     * @param bool  $isPreOrder     Whether item is pre order
     * @param int   $daysToShip     The guaranteed days to ship orders. Please get the days_to_ship range from get_dts_limit api
     * @return $this
     */
    public function setPreOrder(bool $isPreOrder, int $daysToShip = null)
    {
        $preOrder = [
            "is_pre_order" => $isPreOrder
        ];

        if ($daysToShip != null){
            $preOrder["days_to_ship"] = $daysToShip;
        }

        $this->parameters["pre_order"] = $preOrder;

        return $this;
    }

    /**
     * SKU tag of item
     * 
     * @param string $value
     * @return $this
     */
    public function setItemSku(string $value)
    {
        $this->parameters['item_sku'] = $value;

        return $this;
    }

    /**
     * Condition of item, could be USED or NEW
     * 
     * @param string $value
     * @return $this
     */
    public function setCondition(string $value)
    {
        $this->parameters['condition'] = $value;

        return $this;
    }

    /**
     * Wholesale setting
     * 
     * @param array<Wholesale> $value
     * @return $this
     */
    public function setWholesale(array $value)
    {
        $this->parameters['wholesale'] = $value;

        return $this;
    }

    /**
     * Video upload ID returned from video uploading API. Only accept one video_upload_id.
     * 
     * @param array<string> $value
     * @return $this
     */
    public function setVideoUploadId(array $value)
    {
        $this->parameters['video_upload_id'] = $value;

        return $this;
    }

    /**
     * 
     * @param int       $brandId            Id of brand.
     * @param string    $originalBrandName  Original name of brand( No Brand if not brand).
     * @return $this
     */
    public function setBrand(int $brandId, string $originalBrandName)
    {
        $this->parameters['brand'] = [
            "brand_id"              => $brandId,
            "original_brand_name"   => $originalBrandName,
        ];

        return $this;
    }

    /**
     * This field is only applicable for local sellers in Indonesia and Malaysia. 
     * Use this field to identify whether a product is a dangerous product. 
     * 0 for non-dangerous product and 1 for dangerous product. 
     * For more information, please visit the market's respective Seller Education Hub.
     * 
     * @param int $value
     * @return $this
     */
    public function setItemDangerous(int $value)
    {
        $this->parameters['item_dangerous'] = $value;

        return $this;
    }
        
    /**
     * Tax information
     * 
     * @param string $hsCode            HS Code (Only for IN region)
     * @param string $taxCode           Tax Code (Only for IN region)
     * @param string $ncm               Mercosur Common Nomenclature, it is a convention between Mercosur member countries to easily recognize goods, services and productive factors negotiated among themselves. (BR region)
     * @param string $sameStateCfop     Tax Code of Operations and Installments for orders that seller and buyer are in the same state. It identifies a specific operation by category at the time of issuing the invoice.(BR region)
     * @param string $diffStateCfop     Tax Code of Operations and Installments for orders that seller and buyer are in different states. It identifies a specific operation by category at the time of issuing the invoice.(BR region)
     * @param string $diffStateCfop     Tax Code of Operations and Installments for orders that seller and buyer are in different states. It identifies a specific operation by category at the time of issuing the invoice.(BR region)
     * @param string $csosn             Code of Operation Status – Simples Nacional, code for company operations to identify the origin of the goods and the taxation regime of the operations.(BR region)
     * @param string $origin            Product source, domestic or foreig (BR region)
     * @param string $cest              (BR region)
     * @param string $measureUnit       (BR region)
     * @param string $invoiceOption     Value shuold be one of NO_INVOICES VAT_MARGIN_SCHEME_INVOICES VAT_INVOICES NON_VAT_INVOICES and if value is NON_VAT_INVOICE vat_rate should be null (PL region)
     * @param string $vatRate           Value should be one of 0% 5% 8% 23% NO_VAT_RATE (PL region)
     * @return $this
     */
    public function setTaxInfo(string $hsCode, string $taxCode, string $ncm = null, string $sameStateCfop = null, string $diffStateCfop = null,
        string $csosn = null, string $origin = null, string $cest = null, string $measureUnit = null, string $invoiceOption = null, 
        string $vatRate = null)
    {
        $taxInfo = [
            "hs_code"   => $hsCode,
            "tax_code"  => $taxCode,
        ];

        if ($ncm != null) {
            $taxInfo["ncm"] = $ncm;
        }
        if ($sameStateCfop != null) {
            $taxInfo["same_state_cfop"] = $sameStateCfop;
        }
        if ($diffStateCfop != null) {
            $taxInfo["diff_state_cfop"] = $diffStateCfop;
        }
        if ($csosn != null) {
            $taxInfo["csosn"] = $csosn;
        }
        if ($origin != null) {
            $taxInfo["origin"] = $origin;
        }
        if ($cest != null) {
            $taxInfo["cest"] = $cest;
        }
        if ($measureUnit != null) {
            $taxInfo["measure_unit"] = $measureUnit;
        }
        if ($invoiceOption != null) {
            $taxInfo["invoice_option"] = $invoiceOption;
        }
        if ($vatRate != null) {
            $taxInfo["vat_rate"] = $vatRate;
        }

        $this->parameters['tax_info'] = $taxInfo;

        return $this;
    }

    /**
     * Complaint Policy for item. Only required for local PL sellers, ignored otherwise.
     * 
     * @param string $warrantyTime                  Value should be in one of ONE_YEAR TWO_YEARS OVER_TWO_YEARS.
     * @param string $excludeEntrepreneurWarranty   Whether to exclude warranty complaints for entrepreneurs.If True means "I exclude warranty complaints for entrepreneur"
     * @param string $complaintAddressId            Address for complaint. Fetch available addresses using v2.logistics.get_address_list, and use address_id returned from it.
     * @param string $additionalInformation         Additional information for warranty claim. Should be less than 1000 characters.
     * @return $this
     */
    public function setComplaintPolicy(string $warrantyTime = null, bool $excludeEntrepreneurWarranty = null, int $complaintAddressId = null, string $additionalInformation = null)
    {
        $complaintPolicy = [];

        if ($warrantyTime != null) {
            $complaintPolicy["warranty_time"] = $warrantyTime;
        }

        if ($excludeEntrepreneurWarranty != null) {
            $complaintPolicy["exclude_entrepreneur_warranty"] = $excludeEntrepreneurWarranty;
        }

        if ($complaintAddressId != null) {
            $complaintPolicy["complaint_address_id"] = $complaintAddressId;
        }

        if ($additionalInformation != null) {
            $complaintPolicy["additional_information"] = $additionalInformation;
        }

        if (!empty($complaintPolicy)){
            $this->parameters['complaint_policy'] = $complaintPolicy;
        }

        return $this;
    }

    /**
     * 
     * 
     * @param Array<FieldList> $fieldList
     * @return $this
     */
    public function setDescriptionInfo(Array $fieldList)
    {
        $this->parameters['description_info']['extended_description']['field_list'] = $fieldList;

        return $this;
    }

    /**
     * Values: See Data Definition- description_type (normal , extended). If you want to use extended_description, this field must be inputed
     * 
     * @param string $value
     * @return $this
     */
    public function setDescriptionType($value)
    {
        $this->parameters['description_type'] = $value;

        return $this;
    }
}