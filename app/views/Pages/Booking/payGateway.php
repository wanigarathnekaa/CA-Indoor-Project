<?php
$amount = isset($_GET['amount']) ? urldecode($_GET['amount']) : 0;
$merchant_id = "1225484";
$order_id = uniqid();
$merchant_secret = "MTI0NjM0MDI4NjM5MDE0NzA0NzIxMTU4ODM1OTEwMTE3MDk0NDk4Mw==";
$currency = "LKR";
//Calculate the hash using MD5 and concatenate various pieces of data
$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);
// Create an associative array with payment-related data
$array = [];
$array['merchant_id'] = $merchant_id;
$array['order_id'] = $order_id;
$array['hash'] = $hash;
$array['currency'] = $currency;
$array['first_name'] = $data->name;
$array['last_name'] = $data->user_name;
$array['email'] = $data->email;
$array['phone'] = $data->phoneNumber;
$array['address'] = "No.1, Galle Road";
$array['city'] = "Colombo";
$array['items'] = "Reservation Payment";

// Convert the array to a JSON string
$jsObj = json_encode($array);

// Output the JSON string
echo $jsObj;

