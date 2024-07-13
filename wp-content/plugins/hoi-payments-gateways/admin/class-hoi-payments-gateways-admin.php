<?php
if (!class_exists('HOI_Payments_Gateways_Admin')) {
    class HOI_Payments_Gateways_Admin {
        private $plugin_name;

        public function __construct($plugin_name) {
            $this->plugin_name = $plugin_name;
        }

        public function register_settings() {
            register_setting('hoi_payments_gateways_group', 'hoi_payments_gateways_settings', array($this, 'sanitize_settings'));

            add_settings_section(
                'hoi_payments_gateways_section',
                'General Settings',
                array($this, 'section_callback'),
                $this->plugin_name
            );

            add_settings_field(
                'stripe_test_api_key',
                'Stripe Test API Key',
                array($this, 'stripe_test_api_key_callback'),
                $this->plugin_name,
                'hoi_payments_gateways_section',
                array('label_for' => 'stripe_test_api_key')
            );

            add_settings_field(
                'stripe_live_api_key',
                'Stripe Live API Key',
                array($this, 'stripe_live_api_key_callback'),
                $this->plugin_name,
                'hoi_payments_gateways_section',
                array('label_for' => 'stripe_live_api_key')
            );

            add_settings_field(
                'paypal_test_client_id',
                'PayPal Test Client ID',
                array($this, 'paypal_test_client_id_callback'),
                $this->plugin_name,
                'hoi_payments_gateways_section',
                array('label_for' => 'paypal_test_client_id')
            );

            add_settings_field(
                'paypal_live_client_id',
                'PayPal Live Client ID',
                array($this, 'paypal_live_client_id_callback'),
                $this->plugin_name,
                'hoi_payments_gateways_section',
                array('label_for' => 'paypal_live_client_id')
            );
        }

        public function add_plugin_admin_menu() {
            add_menu_page(
                'HOI Payments Gateways Settings',
                'HOI Payments',
                'manage_options',
                'hoi-payments-gateways',
                array($this, 'display_plugin_admin_page'),
                'dashicons-admin-generic',
                90
            );
        }

        public function display_plugin_admin_page() {
            include_once 'partials/hoi-payments-gateways-admin-display.php';
        }

        public function sanitize_settings($input) {
            $sanitized_input = array();

            $fields = [
                'stripe_test_api_key',
                'stripe_live_api_key',
                'paypal_test_client_id',
                'paypal_live_client_id',
            ];

            foreach ($fields as $field) {
                if (isset($input[$field])) {
                    $sanitized_input[$field] = sanitize_text_field($input[$field]);
                }
            }

            return $sanitized_input;
        }

        public function section_callback() {
            echo '<p>General settings for the HOI Payments Gateways plugin.</p>';
        }

        private function get_option_value($option_name) {
            $options = get_option('hoi_payments_gateways_settings', array());
            return isset($options[$option_name]) ? $options[$option_name] : '';
        }

        public function stripe_test_api_key_callback($args) {
            $value = $this->get_option_value($args['label_for']);
            echo '<input type="text" id="' . esc_attr($args['label_for']) . '" name="hoi_payments_gateways_settings[' . esc_attr($args['label_for']) . ']" value="' . esc_attr($value) . '">';
        }

        public function stripe_live_api_key_callback($args) {
            $value = $this->get_option_value($args['label_for']);
            echo '<input type="text" id="' . esc_attr($args['label_for']) . '" name="hoi_payments_gateways_settings[' . esc_attr($args['label_for']) . ']" value="' . esc_attr($value) . '">';
        }

        public function paypal_test_client_id_callback($args) {
            $value = $this->get_option_value($args['label_for']);
            echo '<input type="text" id="' . esc_attr($args['label_for']) . '" name="hoi_payments_gateways_settings[' . esc_attr($args['label_for']) . ']" value="' . esc_attr($value) . '">';
        }

        public function paypal_live_client_id_callback($args) {
            $value = $this->get_option_value($args['label_for']);
            echo '<input type="text" id="' . esc_attr($args['label_for']) . '" name="hoi_payments_gateways_settings[' . esc_attr($args['label_for']) . ']" value="' . esc_attr($value) . '">';
        }
    }
}
?>

