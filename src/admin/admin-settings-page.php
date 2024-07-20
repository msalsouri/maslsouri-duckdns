<?php

if (!defined('ABSPATH')) {
    exit;
}

function hoi_admin_enqueue_scripts($hook_suffix) {
    if (strpos($hook_suffix, 'hoi-ai-content-generator') !== false) {
        wp_enqueue_style('hoi-admin-styles', plugin_dir_url(__FILE__) . 'css/admin-styles.css');
        wp_enqueue_script('hoi-admin-scripts', plugin_dir_url(__FILE__) . 'js/admin-scripts.js', array('jquery'), false, true);
    }
}
add_action('admin_enqueue_scripts', 'hoi_admin_enqueue_scripts');
