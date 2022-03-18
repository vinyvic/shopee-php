<?php 

session_start();

if (!isset($_SESSION['access_token'])){
    header('Location: ' . 'http://localhost/shopee-php/auth-partner.php');
}

require __DIR__ . '/../vendor/autoload.php';

use Shopee\Client;
use Shopee\Nodes\Product\Parameters\AddItem;
use Shopee\Nodes\Product\Parameters\LogisticInfo;

$config         = ['accessToken' => $_SESSION['access_token']];
$client         = new Client($config);
$logisticInfo   = new LogisticInfo();
$paramsAddItem  = new AddItem;

// Upload Image
$mediaResponse = $client->mediaSpace->uploadImage('https://www.allaction.com.br/assets/images/shop/produtos/chocottone-bites.png');
$mediaResponse = $mediaResponse->getData();
$imageId = $mediaResponse['response']['image_info']['image_id'];

$paramsAddItem->setOriginalPrice(5.6)
    ->setDescription("Sem adição de açúcares, com muito sabor;")
    ->setItemName("Chocolate ao Leite Linea Zero Lactose 30g")
    ->setNormalStock(809)
    ->setWeight(0.03)
    ->setLogisticInfo([$logisticInfo->setLogisticId(90003)->setEnabled(true)->toArray()])
    ->setCategoryId(100786)
    ->setImage([$imageId])
    ->setBrand(0, "NoBrand")
    ->toArray()
;

$response = $client->product->addItem($paramsAddItem);

echo '<pre>';
print_r($response->getData());

