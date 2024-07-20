<?php

if (!defined('ABSPATH')) {
    exit;
}

function hoi_register_stripe_settings() {
    register_setting('hoi_stripe_settings_group', 'hoi_stripe_test_api_key');
    register_setting('hoi_stripe_settings_group', 'hoi_stripe_live_api_key');
}
add_action('admin_init', 'hoi_register_stripe_settings');

function hoi_admin_notices() {
    if (get_transient('hoi_settings_saved')) {
        echo '<div id="message" class="updated notice is-dismissible"><p>Settings saved successfully.</p></div>';
        delete_transient('hoi_settings_saved');
    }
}
add_action('admin_notices', 'hoi_admin_notices');

function hoi_save_settings_transient() {
    if (isset($_GET['settings-updated']) && $_GET['settings-updated'] === 'true') {
        delete_transient('hoi_settings_saved'); // Clear any existing transient
        set_transient('hoi_settings_saved', true, 5); // Set a new transient
    }
}
add_action('admin_init', 'hoi_save_settings_transient');
