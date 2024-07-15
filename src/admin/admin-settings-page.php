<?php

// Add Admin Menu
add_action('admin_menu', 'ai_content_generator_menu');

function ai_content_generator_menu() {
    add_menu_page('AI Content Generator', 'AI Content Generator', 'manage_options', 'ai-content-generator', 'ai_content_generator_page');
    add_submenu_page('ai-content-generator', 'Settings', 'Settings', 'manage_options', 'ai-content-generator-settings', 'ai_content_generator_settings_page');
}

// Main Plugin Page
function ai_content_generator_page() {
    include plugin_dir_path(__FILE__) . '../templates/admin-page-template.php';
}

// Settings Page
function ai_content_generator_settings_page() {
    // Buffer output to prevent premature header output.
    ob_start();
    ?>
    <div class="wrap">
        <h1>AI Content Generator Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ai_content_generator_settings');
            do_settings_sections('ai-content-generator-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
    // Send the output buffer.
    ob_end_flush();
}

add_action('admin_init', 'ai_content_generator_settings_init');

function ai_content_generator_settings_init() {
    add_settings_section(
        'ai_content_generator_section',
        'API Settings',
        'ai_content_generator_section_callback',
        'ai-content-generator-settings'
    );

    add_settings_field(
        'ai_content_generator_api_key',
        'API Key',
        'ai_content_generator_api_key_callback',
        'ai-content-generator-settings',
        'ai_content_generator_section'
    );

    register_setting('ai_content_generator_settings', 'ai_content_generator_api_key');
}

function ai_content_generator_section_callback() {
    echo 'Enter your API key for the AI Content Generator.';
}

function ai_content_generator_api_key_callback() {
    $api_key = get_option('ai_content_generator_api_key');
    echo '<input type="text" name="ai_content_generator_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}
