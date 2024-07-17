<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function stripe_payment_form_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . '../templates/stripe-payment-form.php';
    return ob_get_clean();
}

add_shortcode('stripe_payment_form', 'stripe_payment_form_shortcode');
