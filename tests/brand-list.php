<?php 

session_start();

if (!isset($_SESSION['access_token'])){
    header('Location: ' . 'http://localhost/shopee-php/auth-partner.php');
}

require __DIR__ . '/../vendor/autoload.php';

use Shopee\Client;
$config = ['accessToken' => $_SESSION['access_token']];
$client = new Client($config);

$paramsBrand = [
    'language' => 'pt-br',
    'status'    => 1,
    'category_id' => 100786,
    'offset'        => 0,
    'page_size'     => 10,
    'item_status'   => 'NORMAL'
];

$response = $client->product->getBrandList($paramsBrand);

echo '<pre>';
print_r($response->getData());

