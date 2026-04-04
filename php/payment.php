<?php
require 'vendor/autoload.php';

composer require stripe/stripe-php

\Stripe\Stripe::setApiKey("YOUR_SECRET_KEY");

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'egp',
            'product_data' => ['name' => 'تبرع'],
            'unit_amount' => $_POST['amount'] * 100,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost/project/success.php',
    'cancel_url' => 'http://localhost/project/cancel.php',
]);

header("Location: " . $session->url);