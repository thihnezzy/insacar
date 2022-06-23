<?php

if (empty($_POST['price']) || empty($_POST['daydifference'])) {
  header('Location: https://vhost1/ProjetApplication/order/cancel');
}


$price = (is_numeric($_POST['price']) ? (int)$_POST['price'] : 0);
$daydiff = (is_numeric($_POST['daydifference']) ? (int)$_POST['daydifference'] : 0);

echo $price;
echo $daydiff;

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51LCg28Ic6AS6fjfljEPFs5wAWF0VGpbJBdskCIAZArj4GPr7SpNF5uIb6K4OWHBjLO9IB8XkomzRyGBQ3MXpJsaA00ZlY1cYAw');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://vhost1/ProjetApplication';

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'eur',
        'product_data' => [
          'name' => 'INSA CAR Checkout',
        ],
        'unit_amount' => $price*$daydiff*100,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/order/success',
  'cancel_url' => $YOUR_DOMAIN . '/order/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $session->url);