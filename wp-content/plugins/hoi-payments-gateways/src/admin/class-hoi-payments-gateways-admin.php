<?php

class Hoi_Payments_Gateways_Admin {

    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function add_plugin_admin_menu() {
        add_menu_page(
            'Hoi Payments Gateways Settings',
            'Hoi Payments Gateways',
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_admin_page')
        );
    }

    public function display_plugin_admin_page() {
        include_once 'partials/hoi-payments-gateways-admin-display.php';
    }

    public function register_settings() {
        register_setting(
            'hoi_payments_gateways_group',
            'hoi_payments_gateways_options'
        );

        add_settings_section(
            'hoi_payments_gateways_section',
            'General Settings',
            null,
            'hoi_payments_gateways'
        );

        add_settings_field(
            'stripe_api_key',
            'Stripe API Key',
            array($this, 'stripe_api_key_callback'),
            'hoi_payments_gateways',
            'hoi_payments_gateways_section'
        );

        add_settings_field(
            'stripe_api_secret',
            'Stripe API Secret',
            array($this, 'stripe_api_secret_callback'),
            'hoi_payments_gateways',
            'hoi_payments_gateways_section'
        );

        add_settings_field(
            'paypal_client_id',
            'PayPal Client ID',
            array($this, 'paypal_client_id_callback'),
            'hoi_payments_gateways',
            'hoi_payments_gateways_section'
        );

        add_settings_field(
            'paypal_client_secret',
            'PayPal Client Secret',
            array($this, 'paypal_client_secret_callback'),
            'hoi_payments_gateways',
            'hoi_payments_gateways_section'
        );
    }

    public function stripe_api_key_callback() {
        $options = get_option('hoi_payments_gateways_options');
        echo '<input type="text" name="hoi_payments_gateways_options[stripe_api_key]" value="' . esc_attr($options['stripe_api_key']) . '">';
    }

    public function stripe_api_secret_callback() {
        $options = get_option('hoi_payments_gateways_options');
        echo '<input type="text" name="hoi_payments_gateways_options[stripe_api_secret]" value="' . esc_attr($options['stripe_api_secret']) . '">';
    }

    public function paypal_client_id_callback() {
        $options = get_option('hoi_payments_gateways_options');
        echo '<input type="text" name="hoi_payments_gateways_options[paypal_client_id]" value="' . esc_attr($options['paypal_client_id']) . '">';
    }

    public function paypal_client_secret_callback() {
        $options = get_option('hoi_payments_gateways_options');
        echo '<input type="text" name="hoi_payments_gateways_options[paypal_client_secret]" value="' . esc_attr($options['paypal_client_secret']) . '">';
    }
}
?>
