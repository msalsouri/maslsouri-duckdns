<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function register_stripe_settings() {
    register_setting('stripe_settings_group', 'stripe_test_api_key');
    register_setting('stripe_settings_group', 'stripe_live_api_key');
}

add_action('admin_init', 'register_stripe_settings');
