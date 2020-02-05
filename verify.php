<?php

// Khalti Transaction verification
// PHP Script 

$token = $_POST['token'];
$amount = $_POST['amount'];

$args = http_build_query(array(
'token' => $token,
'amount'  => $amount
));

$url = "https://khalti.com/api/payment/verify/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = ['Authorization: Key test_secret_key_c406db1d5d0e425a991d6de296d329e3'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// for debug
curl_setopt($ch, CURLINFO_HEADER_OUT, true);

// Response
$response = curl_exec($ch);

$dump = array(
    "curl" => curl_getinfo($ch),
    "khalti" => $response
);

curl_close($ch);

die(json_encode($dump, JSON_PRETTY_PRINT));