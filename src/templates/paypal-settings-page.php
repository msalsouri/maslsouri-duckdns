<div class="wrap">
    <h1>PayPal Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'hoi_paypal_settings_group' );
        do_settings_sections( 'hoi_paypal_settings_group' );
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">PayPal Test Client ID</th>
                <td><input type="text" name="hoi_paypal_test_client_id" value="<?php echo esc_attr( get_option('hoi_paypal_test_client_id') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">PayPal Test Secret</th>
                <td><input type="text" name="hoi_paypal_test_secret" value="<?php echo esc_attr( get_option('hoi_paypal_test_secret') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">PayPal Live Client ID</th>
                <td><input type="text" name="hoi_paypal_live_client_id" value="<?php echo esc_attr( get_option('hoi_paypal_live_client_id') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">PayPal Live Secret</th>
                <td><input type="text" name="hoi_paypal_live_secret" value="<?php echo esc_attr( get_option('hoi_paypal_live_secret') ); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
