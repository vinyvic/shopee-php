<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class InitTierVariation extends RequestParameters
{
    /**
     * ID of item
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
     * Tier variation info list.If you define a one-tier structure, the maximum number of options cannot exceed 50. 
     * If you define a two-tier structure, the number of options multiplied by the two tiers cannot exceed 50.
     *
     * @param array<TierVariation> $value
     * @return $this
     */
    public function setTierVaration(array $value)
    {
        $this->parameters['tier_variation'] = $value;

        return $this;
    }

    /**
     * Model info list, model number at most 50
     * 
     * @param array<Model> $value
     * @return $this
     */
    public function setModel(array $value)
    {
        $this->parameters['model'] = $value;

        return $this;
    }
}

class TierVariation extends RequestParameters
{
    /**
     * Tier variation name
     * 
     * @param string value
     * @return $this
     */
    public function setName(string $value)
    {
        $this->parameters['name'] = $value;
        return $this;
    }

    /**
     * Tier variation option info list
     * 
     * @param array<OptionList> value
     * @return $this
     */
    public function setOptionList(array $value)
    {
        $this->parameters['option_list'] = $value;
        return $this;
    }
}

class OptionList extends RequestParameters
{
    /**
     * option Name
     * 
     * @param string value
     * @return $this
     */
    public function setOption(string $value)
    {
        $this->parameters['option'] = $value;
        return $this;
    }

    /**
     * ID of image
     * 
     * @param string value
     * @return $this
     */
    public function setImage(string $value)
    {
        $this->parameters['image']['image_id'] = $value;
        return $this;
    }
}

class Model extends RequestParameters
{
    /**
     * Tier index of this model
     * 
     * @param array<int> $value
     * @return $this
     */
    public function setTierIndex(array $value)
    {
        $this->parameters['tier_index'] = $value;

        return $this;
    }

    /**
     * Normal stock of this model
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
     * Original price of this model
     * 
     * @param float $value
     * @return $this
     */
    public function setOriginalPrice(float $value)
    {
        $this->parameters['original_price'] = $value;

        return $this;
    }

    /**
     * Seller SKU of this model, model_sku length information needs to be no more than 100 characters.
     * 
     * @param string $value
     * @return $this
     */
    public function setModelSku(string $value)
    {
        $this->parameters['model_sku'] = $value;

        return $this;
    }
}