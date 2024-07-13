<?php
/*
  Plugin Name:       HOI Payments Gateways
  Plugin URI:        https://hoiltd.com/hoi-payments-gateways-uri/
  Description:       HOI WordPress Payments Gateways for Stripe, PayPal and Beyond.
  Version:           1.0.0
  Author:            MOHAMMAD AL-SOURI
  Author URI:        https://msalsouri.github.io/
  License:           GPL-2.0+
  License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
  Text Domain:       hoi-payments-gateways
  Domain Path:       /languages
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'HOI_PAYMENTS_GATEWAYS_VERSION', '1.0.0' );

function activate_hoi_payments_gateways() {
    ob_start();
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-hoi-payments-gateways-activator.php';
    Hoi_Payments_Gateways_Activator::activate();
    ob_end_clean();
}

function deactivate_hoi_payments_gateways() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-hoi-payments-gateways-deactivator.php';
    Hoi_Payments_Gateways_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_hoi_payments_gateways' );
register_deactivation_hook( __FILE__, 'deactivate_hoi_payments_gateways' );

require plugin_dir_path( __FILE__ ) . 'includes/class-hoi-payments-gateways.php';

function run_hoi_payments_gateways() {
    $plugin = new Hoi_Payments_Gateways();
    $plugin->run();
}
run_hoi_payments_gateways();
?>

