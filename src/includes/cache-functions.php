<?php

function clear_cache() {
    // Logic to clear cache
    $success = true; // Set to false if cache clearing fails

    if ($success) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_clear_cache', 'clear_cache');
