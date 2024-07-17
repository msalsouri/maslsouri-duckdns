<?php

if (!defined('ABSPATH')) {
    exit;
}

class ASP_Stripe_API {
    private $stripe_test_api_key;
    private $stripe_live_api_key;

    public function __construct() {
        $this->stripe_test_api_key = get_option('stripe_test_api_key');
        $this->stripe_live_api_key = get_option('stripe_live_api_key');
    }

    public function get_test_api_key() {
        return $this->stripe_test_api_key;
    }

    public function get_live_api_key() {
        return $this->stripe_live_api_key;
    }
}
