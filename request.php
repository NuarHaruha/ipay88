<?php
require_once './IPay88.class.php';
$ipay88 = new IPay88('MERCHANT_CODE', 'MERCHANT_KEY');

$ipay88->setTransactionType(IPay88::TRANSACTION_TYPE_PAYMENT);
//$ipay88->setTransactionType(IPay88::TRANSACTION_TYPE_RECURRING_SUBSCRIPTION);
//$ipay88->setTransactionType(IPay88::TRANSACTION_TYPE_RECURRING_TERMINATION);

$ipay88->setField('RefNo', '12345');

if ($ipay88->getTransactionType() == IPay88::TRANSACTION_TYPE_PAYMENT) {
    // For standard online payment.
    $ipay88->setField('PaymentId', 2);
    $ipay88->setField('Amount', '1.00');
    $ipay88->setField('Currency', 'MYR');
    $ipay88->setField('ProdDesc', 'Testing payment');
    $ipay88->setField('UserName', 'Testing');
    $ipay88->setField('UserEmail', 'your@email.com');
    $ipay88->setField('UserContact', '0123456789');
    $ipay88->setField('Remark', 'Lorem isum dolor');
    $ipay88->setField('Lang', 'utf-8');
    $ipay88->setField('ResponseURL', 'http://[yourdomain]/response.php');
}
else if ($ipay88->getTransactionType() == IPay88::TRANSACTION_TYPE_RECURRING_SUBSCRIPTION) {
    // For recurring subscription payment.
    $ipay88->setField('FirstPaymentDate', '22042012');
    $ipay88->setField('Currency', 'MYR');
    $ipay88->setField('Amount', '1.00');
    $ipay88->setField('NumberOfPayments', 1);
    $ipay88->setField('Frequency', 1);
    $ipay88->setField('Desc', 'Testing recurring payment');
    $ipay88->setField('CC_Name', 'John Doe');
    $ipay88->setField('CC_PAN', '1111111111111111');
    $ipay88->setField('CC_CVC', '111');
    $ipay88->setField('CC_ExpiryDate', '122020');
    $ipay88->setField('CC_Country', 'Malaysia');
    $ipay88->setField('CC_Bank', 'Maybank');
    $ipay88->setField('CC_Ic', '888888888888');
    $ipay88->setField('CC_Email', 'your@email.com');
    $ipay88->setField('CC_Phone', '0123456789');
    $ipay88->setField('CC_Remark', 'Bla bla..');
    $ipay88->setField('P_Name', 'John Doe');
    $ipay88->setField('P_Email', 'your@email.com');
    $ipay88->setField('P_Phone', '0123456789');
    $ipay88->setField('P_Addrl1', 'Lorem');
    $ipay88->setField('P_Addrl2', 'Ipsum');
    $ipay88->setField('P_City', 'Dolor');
    $ipay88->setField('P_State', 'Kuala Lumpur');
    $ipay88->setField('P_Zip', '50000');
    $ipay88->setField('P_Country', 'Malaysia');
    $ipay88->setField('ResponseURL', 'http://[yourdomain]/recurring_response.php');
}
else if ($ipay88->getTransactionType() == IPay88::TRANSACTION_TYPE_RECURRING_TERMINATION) {
    // For recurring termination request.
    // Only requires RefNo, MerchantCode, and Signature which is already set.
}

$ipay88->generateSignature();

$ipay88Fields = $ipay88->getFields();
?>
<!doctype html>
<html>
<head>
    <title>IPay88 - Test - Request</title>
</head>
<body>
    <h1>IPay88 payment gateway</h1>

    <p>Transaction type: <?php echo $ipay88->getTransactionType(); ?></p>

    <?php if (!empty($ipay88Fields)): ?>
        <form action="<?php echo $ipay88->getTransactionUrl(); ?>" method="post">
            <table>
                <?php foreach ($ipay88Fields as $key => $val): ?>
                    <tr>
                        <td><label><?php echo $key; ?></label></td>
                        <td><input type="text" name="<?php echo $key; ?>" value="<?php echo $val; ?>" /></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                <td colspan="2"><input type="submit" value="Submit" name="Pay with IPay88" /></td>
                </tr>
            </table>
        </form>
    <?php endif; ?>
</body>
</html>