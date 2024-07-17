<?php

function get_stripe_keys() {
    return [
        'test' => get_option('stripe_test_api_key'),
        'live' => get_option('stripe_live_api_key')
    ];
}

function get_paypal_keys() {
    return [
        'test' => [
            'client_id' => get_option('paypal_test_client_id'),
            'secret' => get_option('paypal_test_secret')
        ],
        'live' => [
            'client_id' => get_option('paypal_live_client_id'),
            'secret' => get_option('paypal_live_secret')
        ]
    ];
}
