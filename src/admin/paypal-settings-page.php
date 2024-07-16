<?php
// PayPal Settings Page
function ai_content_generator_paypal_settings_page() {
    // Buffer output to prevent premature header output.
    ob_start();
    ?>
    <div class="wrap">
        <h1>PayPal Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ai_content_generator_paypal_settings');
            do_settings_sections('ai-content-generator-paypal-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
    // Send the output buffer.
    ob_end_flush();
}

add_action('admin_init', 'ai_content_generator_paypal_settings_init');

function ai_content_generator_paypal_settings_init() {
    add_settings_section(
        'ai_content_generator_paypal_section',
        'PayPal API Settings',
        'ai_content_generator_paypal_section_callback',
        'ai-content-generator-paypal-settings'
    );

    add_settings_field(
        'ai_content_generator_paypal_test_api_key',
        'PayPal Test API Key',
        'ai_content_generator_paypal_test_api_key_callback',
        'ai-content-generator-paypal-settings',
        'ai_content_generator_paypal_section'
    );

    add_settings_field(
        'ai_content_generator_paypal_live_api_key',
        'PayPal Live API Key',
        'ai_content_generator_paypal_live_api_key_callback',
        'ai-content-generator-paypal-settings',
        'ai_content_generator_paypal_section'
    );

    register_setting('ai_content_generator_paypal_settings', 'ai_content_generator_paypal_test_api_key');
    register_setting('ai_content_generator_paypal_settings', 'ai_content_generator_paypal_live_api_key');
}

function ai_content_generator_paypal_section_callback() {
    echo 'Enter your PayPal API keys.';
}

function ai_content_generator_paypal_test_api_key_callback() {
    $api_key = get_option('ai_content_generator_paypal_test_api_key');
    echo '<input type="text" name="ai_content_generator_paypal_test_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}

function ai_content_generator_paypal_live_api_key_callback() {
    $api_key = get_option('ai_content_generator_paypal_live_api_key');
    echo '<input type="text" name="ai_content_generator_paypal_live_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}
