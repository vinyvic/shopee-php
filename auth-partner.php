<?php 

require __DIR__ . '/vendor/autoload.php';

$client = new Shopee\Client();
$url = $client->getAuthorizationURL('http://localhost/shopee-php/access-token.php');
header('Location: ' . $url);