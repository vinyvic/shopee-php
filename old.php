<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function dd($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

function post($url, $postFields){
    $postFields = json_encode($postFields);
    // Inicia
    $curl = curl_init();

    // Configura
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_HTTPHEADER => [ 
            'Content-Type:application/json',
            'Content-Length: ' . strlen($postFields)
        ],
        CURLOPT_POSTFIELDS => $postFields
    ]);

    // Envio e armazenamento da resposta
    $response = curl_exec($curl);

    // Fecha e limpa recursos
    curl_close($curl);

    return $response;
}

function get($url){
    // Inicia
    $curl = curl_init();

    // Configura
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url
    ]);

    // Envio e armazenamento da resposta
    $response = curl_exec($curl);

    // Fecha e limpa recursos
    curl_close($curl);

    return $response;
}

define('SHOP_ID',       43534);
define('PARTNER_ID',    1006217);
define('PARTNER_KEY',   'e9c6302b69ac3d7560cc1d6bdce60738009e9ac9c18121c59ac71a021959b157');

// $code = '4843737548674376514a74514f445a44';
$code           = filter_input(INPUT_GET, 'code');
$access_token   = filter_input(INPUT_GET, 'access_token');


$dt = new DateTime();
$timestamp = $dt->getTimestamp();

// request(URL . '?shop_id=' . SHOP_ID . '&partner_id=' . PARTNER_ID .'&timestamp=' . $dt->getTimestamp(), $postFields);
$host = 'https://partner.test-stable.shopeemobile.com';

if ($code){
    $path        = '/api/v2/auth/token/get';
    $base_string = PARTNER_ID . $path . $timestamp;
    $sign        = hash_hmac("sha256", $base_string, PARTNER_KEY);
    $url         = $host . $path . '?partner_id=' . PARTNER_ID . "&timestamp=" . $timestamp . '&sign=' . $sign;
    $response    = json_decode(post($url, ['code' => $code, 'partner_id' => PARTNER_ID, 'shop_id' => SHOP_ID]));

    if ($response->error){
        echo json_encode($response);
    }
    else {
        header('Location: http://localhost/shopee?access_token=' . $response->access_token . '&refresh_token=' . $response->refresh_token);
    }
}
else if($access_token){
    $path        = '/api/v2/product/add_item';
    // $path       = '/api/v2/logistics/get_channel_list';
    $base_string = PARTNER_ID . $path . $timestamp . $access_token . SHOP_ID;
    $sign        = hash_hmac("sha256", $base_string, PARTNER_KEY);
    $url         = $host . $path . '?partner_id=' . PARTNER_ID . "&timestamp=" . $timestamp . "&access_token=" . $access_token . '&shop_id=' . SHOP_ID . '&sign=' . $sign ;
    
    $postFields = [
        "original_price" => 123.3,
        "description"    => "item description test",
        "weight"         => 1.1,
        "item_name"      => "Example",
        "normal_stock"   => 33,
        "logistic_info"  => [
                [
                "enabled" => true,
                "logistic_id" => 90003]
        ],
        "category_id" => 101175,
        "image" => [
            "image_id_list" => ['https://www.allaction.com.br/assets/images/shop/produtos/trink-tanjerina.png']
        ],
        "brand" => [
            "brand_id" => 1149696,
            "original_brand_name" => "Elianware"
        ],
        "description_type" => "normal"
    ];

    // $postFields = [];
    // $url = $host . $path . '?partner_id=' . PARTNER_ID . "&timestamp=" . $timestamp . "&access_token=" . $access_token . '&shop_id=' . SHOP_ID . '&sign=' . $sign ;

    $response = post($url, $postFields);

    echo $response;
}
else {
    $path        = '/api/v2/shop/auth_partner';
    $base_string = PARTNER_ID . $path . $timestamp;
    $sign        = hash_hmac("sha256", $base_string, PARTNER_KEY);
    $url         = $host . $path . '?partner_id=' . PARTNER_ID . "&timestamp=" . $timestamp . '&sign=' . $sign . '&redirect=http://localhost/shopee-php';
    header('Location: ' . $url);
}
