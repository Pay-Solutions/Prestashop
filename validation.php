<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/thaiepay.php');
           


$currency = new Currency(intval(isset($_POST['currency_payement']) ? $_POST['currency_payement'] : $cookie->id_currency));
$total = floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));

$thaiepay = new thaiepay();
$thaiepay->validateOrder($cart->id,  _PS_OS_PREPARATION_, $total, $thaiepay->displayName, NULL, NULL, $currency->id);
$order = new Order($thaiepay->currentOrder);

Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?id_cart='.$cart->id.'&id_module='.$thaiepay->id.'&id_order='.$thaiepay->currentOrder.'&key='.$order->secure_key);


//=============================================================================================================================

?>
