<?php 

session_start();

if (!isset($_SESSION['access_token'])){
    header('Location: ' . 'http://localhost/shopee-php/auth-partner.php');
}

require __DIR__ . '/vendor/autoload.php';

use Shopee\Client;

$config = ['accessToken' => $_SESSION['access_token']];
$client = new Client($config);

// $params = [
//     "original_price" => 123.3,
//     "description"    => "item description test",
//     "weight"         => 1.1,
//     "item_name"      => "Example",
//     "normal_stock"   => 33,
//     "logistic_info"  => [
//             [
//             "enabled" => true,
//             "logistic_id" => 90003]
//     ],
//     "category_id" => 101175,
//     "image" => [
//         "image_url_list" => [
//             'https://www.allaction.com.br/assets/images/shop/produtos/trink-tanjerina.png',
//         ],
//         "image_id_list" => [
//             "a17bb867ecfe900e92e460c57b892590"
//         ]
//     ],
//     "brand" => [
//         "brand_id" => 1149696,
//         "original_brand_name" => "Elianware"
//     ],
//     "description_type" => "normal"
// ];

// $response = $client->product->addItem($params);

$params = [
    'offset'        => 0,
    'page_size'     => 10,
    'item_status'   => 'NORMAL'
];

$response = $client->product->getItemsList($params);

echo '<pre>';
print_r($response->getData());

