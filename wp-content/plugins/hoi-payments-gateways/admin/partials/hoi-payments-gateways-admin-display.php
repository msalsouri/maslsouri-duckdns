<h2>HOI Payments Gateways Settings</h2>
<form method="post" action="options.php">
    <?php
    settings_fields('hoi_payments_gateways_group');
    do_settings_sections('hoi-payments-gateways');
    submit_button();
    ?>
</form>
