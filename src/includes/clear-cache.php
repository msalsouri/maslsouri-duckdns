<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hoi_clear_cache() {
    // Clear WordPress cache
    if (function_exists('wp_cache_flush')) {
        wp_cache_flush();
        wp_send_json_success('Cache successfully cleared.');
    } else {
        wp_send_json_error('Failed to clear cache.');
    }
}

add_action('wp_ajax_hoi_clear_cache', 'hoi_clear_cache');
