<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hoi_admin_menu() {
    add_menu_page(
        'HOI AI Content Generator',
        'HOI AI Content Generator',
        'manage_options',
        'hoi-ai-content-generator',
        'hoi_admin_page',
        'dashicons-admin-generic'
    );

    add_submenu_page(
        'hoi-ai-content-generator',
        'API Settings',
        'API Settings',
        'manage_options',
        'hoi-api-settings',
        'hoi_api_settings_page'
    );

    add_submenu_page(
        'hoi-ai-content-generator',
        'Stripe Settings',
        'Stripe Settings',
        'manage_options',
        'hoi-stripe-settings',
        'hoi_stripe_settings_page'
    );

    add_submenu_page(
        'hoi-ai-content-generator',
        'PayPal Settings',
        'PayPal Settings',
        'manage_options',
        'hoi-paypal-settings',
        'hoi_paypal_settings_page'
    );
}
add_action('admin_menu', 'hoi_admin_menu');

function hoi_admin_page() {
    include plugin_dir_path(__FILE__) . '../templates/admin-page-template.php';
}

function hoi_api_settings_page() {
    include plugin_dir_path(__FILE__) . '../templates/api-settings-page.php';
}

function hoi_stripe_settings_page() {
    include plugin_dir_path(__FILE__) . '../templates/stripe-settings-page.php';
}

function hoi_paypal_settings_page() {
    include plugin_dir_path(__FILE__) . '../templates/paypal-settings-page.php';
}
