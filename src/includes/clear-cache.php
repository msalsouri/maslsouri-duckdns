<?php

if (!defined('ABSPATH')) {
    exit;
}

function hoi_clear_cache() {
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }

    wp_send_json_success('Cache successfully cleared.');
}

add_action('wp_ajax_hoi_clear_cache', 'hoi_clear_cache');
?>
