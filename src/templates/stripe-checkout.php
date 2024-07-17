<?php
/* Template Name: Stripe Checkout */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once 'path/to/stripe-php/init.php'; // Adjust the path to where your Stripe PHP library is located.

\Stripe\Stripe::setApiKey('your-secret-key');

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => 'T-shirt',
            ],
            'unit_amount' => 2000,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://your-domain.com/success',
    'cancel_url' => 'https://your-domain.com/cancel',
]);

echo '<a href="' . $session->url . '" class="stripe-button">Checkout</a>';
?>
