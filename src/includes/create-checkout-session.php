<?php
require 'vendor/autoload.php'; // Ensure you have the Stripe PHP library installed via Composer
\Stripe\Stripe::setApiKey(get_option('hoi_stripe_secret_key'));

header('Content-Type: application/json');

try {
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
        'success_url' => home_url('/success?session_id={CHECKOUT_SESSION_ID}'),
        'cancel_url' => home_url('/cancel'),
    ]);

    echo json_encode(['id' => $session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
