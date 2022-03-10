<?php

namespace Shopee\Nodes\MediaSpace\Parameters;

use Shopee\RequestParameters;
use GuzzleHttp\Psr7;

class UploadImage extends RequestParameters
{
    public function setUploadImage($url)
    {
        $this->parameters['name'] = 'image';
        $this->parameters['contents'] = Psr7\Utils::tryFopen($url, 'r');
        return $this;
    }
}