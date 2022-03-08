<?php 

require __DIR__ . '/vendor/autoload.php';

use Shopee\Client;

$client = new Client();

session_start();

if (isset($_SESSION['access_token'])){
    header('Location: ' . 'http://localhost/shopee-php/');
}

$code   = filter_input(INPUT_GET, 'code');
$shopId = filter_input(INPUT_GET, 'shop_id');

function redirAuth(){
    $urlAuth = 'http://localhost/shopee-php/auth-partner.php';
    header('Location: ' . $urlAuth);
}

if (!$code || !$shopId){
    redirAuth();
}
echo '<pre>';
try { 
    $response = json_decode($client->generateAccessToken($code, $shopId));
    if ($response->access_token){
        $_SESSION['access_token']   = $response->access_token;
        $_SESSION['refresh_token']  = $response->refresh_token;
    }
    
    print_r($response);
} catch (Exception $th) {
    redirAuth();
}

// if ($response->error){
//     echo json_encode($response);
// }
// else {
//     header('Location: http://localhost/shopee?access_token=' . $response->access_token . '&refresh_token=' . $response->refresh_token);
// }