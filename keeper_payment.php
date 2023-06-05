<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/stripe-php-master/init.php';

$stripe = new \Stripe\StripeClient('sk_test_51MebYrAvrdybUPpymlJjleUJIhHmblO5fJ1UtWgACp0U6r3ErplFZ1aBWDDdfWBJrJwXPMiq4ouv23J2W3B4vFe600NHybzzI5');

$products = $stripe->products->create([
  'name' => 'TributeKeeper',
]);

$price = $stripe->prices->create([
  'unit_amount' => 2000,
  'currency' => 'usd',
  'product' => $products->id,
]);

$checkout = $stripe->checkout->sessions->create([
  'success_url' => 'https://tributekeeper.com/success_keeper_payment?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => 'https://tributekeeper.com/cancel_payment',
  'payment_method_types' => ['card'],
  'line_items' => [
      [
          'price' => $price->id,
          'quantity' => 2,
      ],
  ],
  'mode' => 'payment', // Set the mode to 'payment' for one-time purchase
]);

header('Location: ' . $checkout->url);