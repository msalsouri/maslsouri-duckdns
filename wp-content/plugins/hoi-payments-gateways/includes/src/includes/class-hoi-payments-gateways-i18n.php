<?php

class Hoi_Payments_Gateways_i18n {

    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'hoi-payments-gateways',
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
?>
