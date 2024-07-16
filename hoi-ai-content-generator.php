<?php
/**
 * Plugin Name: HOI AI Content Generator
 * Plugin URI:  https://hoiltd.com.com
 * Description: A plugin to generate content and provide SEO suggestions using AI.
 * Version:     1.0
 * Author:      MOHAMMAD AL-SOURI
 * Author URI:  https://msalsouri.github.io
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: hoi-ai-content-generator
 * Domain Path: /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Include admin settings page
require_once plugin_dir_path(__FILE__) . 'src/admin/admin-settings-page.php';
require_once plugin_dir_path(__FILE__) . 'src/admin/stripe-settings-page.php';
require_once plugin_dir_path(__FILE__) . 'src/admin/paypal-settings-page.php';

// Include AI functions
require_once plugin_dir_path(__FILE__) . 'src/includes/ai-functions.php';
require_once plugin_dir_path(__FILE__) . 'src/includes/seo-functions.php';
require_once plugin_dir_path(__FILE__) . 'src/includes/meta-functions.php';
require_once plugin_dir_path(__FILE__) . 'src/includes/clear-cache.php';

// Enqueue admin styles and scripts
function hoi_admin_enqueue_scripts($hook_suffix) {
    if (strpos($hook_suffix, 'ai-content-generator') !== false) {
        wp_enqueue_style('hoi-admin-styles', plugin_dir_url(__FILE__) . 'src/admin/css/admin-styles.css');
        wp_enqueue_script('hoi-admin-scripts', plugin_dir_url(__FILE__) . 'src/admin/js/admin-scripts.js', array('jquery'), false, true);
    }
}
add_action('admin_enqueue_scripts', 'hoi_admin_enqueue_scripts');

// Enqueue public styles and scripts
function hoi_public_enqueue_scripts() {
    wp_enqueue_style('hoi-public-styles', plugin_dir_url(__FILE__) . 'src/public/css/public-styles.css');
    wp_enqueue_script('hoi-public-scripts', plugin_dir_url(__FILE__) . 'src/public/js/public-scripts.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'hoi_public_enqueue_scripts');
