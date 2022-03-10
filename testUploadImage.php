<?php 

session_start();

if (!isset($_SESSION['access_token'])){
    header('Location: ' . 'http://localhost/shopee-php/auth-partner.php');
}

require __DIR__ . '/vendor/autoload.php';

use Shopee\Client;

$config = ['accessToken' => $_SESSION['access_token']];
$client = new Client($config);

$response = $client->mediaSpace->uploadImage('https://www.allaction.com.br/assets/images/shop/produtos/chocottone-bites.png');

echo '<pre>';
print_r($response->getData());

