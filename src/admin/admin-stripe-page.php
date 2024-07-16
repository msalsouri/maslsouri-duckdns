<?php

// Add Admin Menu
add_action('admin_menu', 'stripe_content_generator_menu');

function stripe_content_generator_menu() {
    add_menu_page('Stripe API Keys', 'Stripe API Keys', 'manage_options', 'stripe-api-keys', 'stripe_content_generator_page');
    add_submenu_page('stripe-api-keys', 'Stripe Settings', 'Stripe Settings', 'manage_options', 'stripe-settings', 'stripe_settings_page');
}

// Main Plugin Page
function stripe_content_generator_page() {
    ?>
    <div class="wrap">
        <h1>Stripe API Keys</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('stripe_content_generator_settings');
            do_settings_sections('stripe-api-keys');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Settings Page
function stripe_settings_page() {
    // Buffer output to prevent premature header output.
    ob_start();
    ?>
    <div class="wrap">
        <h1>Stripe Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('stripe_settings');
            do_settings_sections('stripe-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
    // Send the output buffer.
    ob_end_flush();
}

add_action('admin_init', 'stripe_content_generator_settings_init');

function stripe_content_generator_settings_init() {
    add_settings_section(
        'stripe_content_generator_section',
        'Stripe Settings',
        'stripe_content_generator_section_callback',
        'stripe-api-keys'
    );

    add_settings_field(
        'stripe_test_api_key',
        'Stripe Test API Key',
        'stripe_test_api_key_callback',
        'stripe-api-keys',
        'stripe_content_generator_section'
    );

    add_settings_field(
        'stripe_live_api_key',
        'Stripe Live API Key',
        'stripe_live_api_key_callback',
        'stripe-api-keys',
        'stripe_content_generator_section'
    );

    register_setting('stripe_content_generator_settings', 'stripe_test_api_key');
    register_setting('stripe_content_generator_settings', 'stripe_live_api_key');
}

function stripe_content_generator_section_callback() {
    echo 'Enter your Stripe API keys below.';
}

function stripe_test_api_key_callback() {
    $api_key = get_option('stripe_test_api_key');
    echo '<input type="text" name="stripe_test_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}

function stripe_live_api_key_callback() {
    $api_key = get_option('stripe_live_api_key');
    echo '<input type="text" name="stripe_live_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}
