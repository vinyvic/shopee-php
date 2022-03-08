<?php 

require __DIR__ . '/vendor/autoload.php';

use Shopee\Client;

$client = new Client();
$url = $client->getAuthorizationURL('http://localhost/shopee-php/retrieveAccessToken.php');
header('Location: ' . $url);