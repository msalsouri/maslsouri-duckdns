<?php
function load_custom_template( $template ) {
    if ( is_page( 'stripe-checkout' ) ) {
        $template = plugin_dir_path( __FILE__ ) . '../templates/stripe-checkout.php';
    }
    return $template;
}
add_filter( 'template_include', 'load_custom_template' );
