<?php

if (!defined('ABSPATH')) {
    exit;
}

class ASP_PayPal_API {
    private $paypal_test_client_id;
    private $paypal_test_secret;
    private $paypal_live_client_id;
    private $paypal_live_secret;

    public function __construct() {
        $this->paypal_test_client_id = get_option('paypal_test_client_id');
        $this->paypal_test_secret = get_option('paypal_test_secret');
        $this->paypal_live_client_id = get_option('paypal_live_client_id');
        $this->paypal_live_secret = get_option('paypal_live_secret');
    }

    public function get_test_client_id() {
        return $this->paypal_test_client_id;
    }

    public function get_test_secret() {
        return $this->paypal_test_secret;
    }

    public function get_live_client_id() {
        return $this->paypal_live_client_id;
    }

    public function get_live_secret() {
        return $this->paypal_live_secret;
    }
}
