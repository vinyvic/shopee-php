<?php

namespace Shopee\Nodes\Product\Parameters;

use Shopee\RequestParameters;

class FieldList extends RequestParameters 
{
    /**
     * Type of extended description field: values: See Data Definition- description_field_type (text , image).
     * @param string $value
     * @return $this
     */
    public function setFieldType(string $value) {
        $this->parameters["field_type"] = $value;
        return $this;
    }

    /**
     * If field_type is text, text information will be set by this field.
     * @param string $value
     * @return $this
     */
    public function setText(string $value) {
        $this->parameters["text"] = $value;
        return $this;
    }

    /**
     * If field_type is image, image url will be set by this field.
     * @param string $url
     * @return $this
     */
    public function setImageInfo(string $url) {

        $this->parameters["image_info"] = [
            "image_id" => $url
        ];

        return $this;
    }
}