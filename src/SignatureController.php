<?php

namespace Shopee;

use Psr\Http\Message\ServerRequestInterface;
use function hash_hmac;

class SignatureController
{
    private $partnerKey;
    private $partnerId;

    public function __construct(string $partnerKey, string $partnerId)
    {
        $this->partnerKey = $partnerKey;
        $this->partnerId = $partnerId;
    }

    public function generateSignature(string $path, string $accessToken = '', $shopId = ''): string
    {
        $base = $this->partnerId . $path . time();

        if ($accessToken){
            $base .= $accessToken . $shopId;
        }
        
        return hash_hmac('sha256', $base, $this->partnerKey);
    }

    public function isValid(ServerRequestInterface $request): bool
    {
        $url            = (string)$request->getUri();
        $body           = $request->getBody()->getContents();
        $authorization  = $request->getHeaderLine('Authorization');

        if (empty($authorization)) {
            return false;
        }
        if ($this->generateSignature($url, $body) !== $authorization) {
            return false;
        }
        return true;
    }
}