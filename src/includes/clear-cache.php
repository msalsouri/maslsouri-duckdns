<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hoi_clear_cache() {
    // Debugging information
    error_log('hoi_clear_cache function called');

    // Your cache clearing logic
    // Example: clear WordPress cache
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
        error_log('Cache cleared successfully');
    } else {
        error_log('wp_cache_clear_cache function not found');
    }

    // Send success response
    wp_send_json_success('Cache successfully cleared.');
}

add_action('wp_ajax_hoi_clear_cache', 'hoi_clear_cache');
