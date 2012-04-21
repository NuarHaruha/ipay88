<?php
require_once './IPay88.class.php';
$ipay88 = new IPay88('MERCHANT_CODE', 'MERCHANT_KEY');
echo $ipay88->requery(array(
    'RefNo'        => 'REFERENCE_NUMBER',
    'Amount'       => '1.00',
));