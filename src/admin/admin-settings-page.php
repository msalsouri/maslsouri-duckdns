<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hoi_register_settings() {
    register_setting('hoi-api-settings-group', 'hoi_api_key');
}
add_action('admin_init', 'hoi_register_settings');
