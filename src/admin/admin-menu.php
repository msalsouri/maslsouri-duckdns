<?php

function ai_content_generator_menu() {
    add_menu_page('AI Content Generator', 'AI Content Generator', 'manage_options', 'ai-content-generator', 'ai_content_generator_page');
    add_submenu_page('ai-content-generator', 'Settings', 'Settings', 'manage_options', 'ai-content-generator-settings', 'ai_content_generator_settings_page');
    add_submenu_page('ai-content-generator', 'Stripe', 'Stripe', 'manage_options', 'ai-content-generator-stripe', 'stripe_settings_page');
    add_submenu_page('ai-content-generator', 'PayPal', 'PayPal', 'manage_options', 'ai-content-generator-paypal', 'paypal_settings_page');
}

add_action('admin_menu', 'ai_content_generator_menu');

function stripe_settings_page() {
    include plugin_dir_path(__FILE__) . '../templates/stripe-settings-page.php';
}

function paypal_settings_page() {
    include plugin_dir_path(__FILE__) . '../templates/paypal-settings-page.php';
}
