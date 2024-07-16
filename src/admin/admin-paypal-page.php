<?php

// Add Admin Menu
add_action('admin_menu', 'paypal_content_generator_menu');

function paypal_content_generator_menu() {
    add_menu_page('PayPal API Keys', 'PayPal API Keys', 'manage_options', 'paypal-api-keys', 'paypal_content_generator_page');
    add_submenu_page('paypal-api-keys', 'PayPal Settings', 'PayPal Settings', 'manage_options', 'paypal-settings', 'paypal_settings_page');
}

// Main Plugin Page
function paypal_content_generator_page() {
    ?>
    <div class="wrap">
        <h1>PayPal API Keys</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('paypal_content_generator_settings');
            do_settings_sections('paypal-api-keys');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Settings Page
function paypal_settings_page() {
    // Buffer output to prevent premature header output.
    ob_start();
    ?>
    <div class="wrap">
        <h1>PayPal Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('paypal_settings');
            do_settings_sections('paypal-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
    // Send the output buffer.
    ob_end_flush();
}

add_action('admin_init', 'paypal_content_generator_settings_init');

function paypal_content_generator_settings_init() {
    add_settings_section(
        'paypal_content_generator_section',
        'PayPal Settings',
        'paypal_content_generator_section_callback',
        'paypal-api-keys'
    );

    add_settings_field(
        'paypal_sandbox_api_key',
        'PayPal Sandbox API Key',
        'paypal_sandbox_api_key_callback',
        'paypal-api-keys',
        'paypal_content_generator_section'
    );

    add_settings_field(
        'paypal_live_api_key',
        'PayPal Live API Key',
        'paypal_live_api_key_callback',
        'paypal-api-keys',
        'paypal_content_generator_section'
    );

    register_setting('paypal_content_generator_settings', 'paypal_sandbox_api_key');
    register_setting('paypal_content_generator_settings', 'paypal_live_api_key');
}

function paypal_content_generator_section_callback() {
    echo 'Enter your PayPal API keys below.';
}

function paypal_sandbox_api_key_callback() {
    $api_key = get_option('paypal_sandbox_api_key');
    echo '<input type="text" name="paypal_sandbox_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}

function paypal_live_api_key_callback() {
    $api_key = get_option('paypal_live_api_key');
    echo '<input type="text" name="paypal_live_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}
