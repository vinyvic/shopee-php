<?php

namespace Shopee\Nodes\MediaSpace;

use Shopee\Nodes\MediaSpace\Parameters\UploadImage;
use Shopee\Nodes\Node;
use Shopee\ResponseData;

class MediaSpace extends Node
{
    public function __construct($client) {
        parent::__construct($client, '/api/v2/media_space/');
    }

    /**
     * Use this call to Upload video image file.
     *
     * @param string $url
     * @return ResponseData
     */
    public function uploadImage($url): ResponseData
    {
        $param = new UploadImage();
        $parameters = $param->setUploadImage($url)->toArray();
        return $this->formPost('upload_image', $parameters);
    }
}