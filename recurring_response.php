<?php
require_once './IPay88.class.php';
$ipay88 = new IPay88('MERCHANT_CODE', 'MERCHANT_KEY');
$response = $ipay88->getResponse();  // $response now holds the data returned from iPay88.

// Application specific logic goes here to check the response and
// reply back IPay88 with 'OK' message.

// IPay88 will attempt to re-try for 12 times until it received 'OK' message from your application.

echo 'OK';

///////////////////////////////////////
var_dump($response);  // For debug use.
///////////////////////////////////////