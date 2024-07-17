<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hoi_webhook_example() {
    $webhook_event = file_get_contents('php://input');
    if (!$webhook_event) {
        http_response_code(400);
        exit;
    }

    $event = json_decode($webhook_event, true);

    if (isset($event['type'])) {
        switch ($event['type']) {
            case 'payment_intent.succeeded':
                error_log('Payment succeeded: ' . print_r($event, true));
                break;
            case 'payment_intent.payment_failed':
                error_log('Payment failed: ' . print_r($event, true));
                break;
            default:
                error_log('Unhandled event type: ' . $event['type']);
                break;
        }
    }

    http_response_code(200);
    exit;
}

add_action('rest_api_init', function () {
    register_rest_route('hoi/v1', '/webhook', array(
        'methods' => 'POST',
        'callback' => 'hoi_webhook_example',
    ));
});
