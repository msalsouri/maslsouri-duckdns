<?php
if (!class_exists('HOI_Payments_Gateways_Admin')) {
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-hoi-payments-gateways-admin.php';
}

class Hoi_Payments_Gateways {

    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct() {
        $this->plugin_name = 'hoi-payments-gateways';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-hoi-payments-gateways-loader.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-hoi-payments-gateways-i18n.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-hoi-payments-gateways-admin.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-hoi-payments-gateways-public.php';

        $this->loader = new Hoi_Payments_Gateways_Loader();
    }

    private function set_locale() {
        $plugin_i18n = new Hoi_Payments_Gateways_i18n();
        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
    }

    private function define_admin_hooks() {
        $plugin_admin = new Hoi_Payments_Gateways_Admin( $this->get_plugin_name() );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
        $this->loader->add_action( 'admin_init', $plugin_admin, 'register_settings' );
    }

    private function define_public_hooks() {
        $plugin_public = new Hoi_Payments_Gateways_Public( $this->get_plugin_name(), $this->get_version() );
    }

    public function run() {
        $this->loader->run();
    }

    public function get_plugin_name() {
        return $this->plugin_name;
    }

    public function get_version() {
        return $this->version;
    }
}
?>

