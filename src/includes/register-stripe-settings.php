<?php

if (!defined('ABSPATH')) {
    exit;
}

function hoi_register_stripe_settings() {
    register_setting('hoi_stripe_settings_group', 'hoi_stripe_test_api_key');
    register_setting('hoi_stripe_settings_group', 'hoi_stripe_live_api_key');
}
add_action('admin_init', 'hoi_register_stripe_settings');
