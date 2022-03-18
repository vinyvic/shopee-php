<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class GetBrandList extends RequestParameters
{
    public function __construct() {
        $this->setLanguage('pt-br');
    }
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
     * the size of one page.Max=100
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
     * ID of category.
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
     * Brand status , 1: normal brand, 2: pending brand
     *
     * @param int $value
     * @return $this
     */
    public function setStatus(int $value)
    {
        $this->parameters['status'] = $value;

        return $this;
    }

    /**
     * If language is not uploaded, the default language=en, the following are the languages supported by different markets 
     * SG: en ; MY: en / ms-my / zh-hans ; TH: en / th ; VN: en / vi ; PH: en ; TW: en / zh-hant ; ID: en / id ; BR: en / pt-br ; 
     * MX: en / es-mx ; PL: pl ; CO: en/es-CO ; CL: en/es-CL ; FR: en/fr ; ES: en/es-ES ; IN: en/hi . Note: For markets that have 
     * already launched global tree, Crossboard shop only support returning en and zh-hans language data
     *
     * @param string $value
     * @return $this
     */
    public function setLanguage(string $value)
    {
        $this->parameters['language'] = $value;

        return $this;
    }
}