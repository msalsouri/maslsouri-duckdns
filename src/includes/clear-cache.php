<?php

function ai_clear_cache_handler() {
    // Add logic to clear cache here

    // Redirect back with success message
    wp_redirect(add_query_arg('cache_cleared', 'true', wp_get_referer()));
    exit;
}

add_action('admin_post_ai_clear_cache', 'ai_clear_cache_handler');
