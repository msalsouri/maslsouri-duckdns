<?php
// Stripe Settings Page
function ai_content_generator_stripe_settings_page() {
    // Buffer output to prevent premature header output.
    ob_start();
    ?>
    <div class="wrap">
        <h1>Stripe Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ai_content_generator_stripe_settings');
            do_settings_sections('ai-content-generator-stripe-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
    // Send the output buffer.
    ob_end_flush();
}

add_action('admin_init', 'ai_content_generator_stripe_settings_init');

function ai_content_generator_stripe_settings_init() {
    add_settings_section(
        'ai_content_generator_stripe_section',
        'Stripe API Settings',
        'ai_content_generator_stripe_section_callback',
        'ai-content-generator-stripe-settings'
    );

    add_settings_field(
        'ai_content_generator_stripe_test_api_key',
        'Stripe Test API Key',
        'ai_content_generator_stripe_test_api_key_callback',
        'ai-content-generator-stripe-settings',
        'ai_content_generator_stripe_section'
    );

    add_settings_field(
        'ai_content_generator_stripe_live_api_key',
        'Stripe Live API Key',
        'ai_content_generator_stripe_live_api_key_callback',
        'ai-content-generator-stripe-settings',
        'ai_content_generator_stripe_section'
    );

    register_setting('ai_content_generator_stripe_settings', 'ai_content_generator_stripe_test_api_key');
    register_setting('ai_content_generator_stripe_settings', 'ai_content_generator_stripe_live_api_key');
}

function ai_content_generator_stripe_section_callback() {
    echo 'Enter your Stripe API keys.';
}

function ai_content_generator_stripe_test_api_key_callback() {
    $api_key = get_option('ai_content_generator_stripe_test_api_key');
    echo '<input type="text" name="ai_content_generator_stripe_test_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}

function ai_content_generator_stripe_live_api_key_callback() {
    $api_key = get_option('ai_content_generator_stripe_live_api_key');
    echo '<input type="text" name="ai_content_generator_stripe_live_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}
