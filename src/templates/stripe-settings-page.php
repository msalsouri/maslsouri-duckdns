<div class="wrap">
    <h1>Stripe Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields( 'hoi_stripe_settings_group' );
        do_settings_sections( 'hoi_stripe_settings_group' );
        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Stripe Test API Key</th>
                <td><input type="text" name="hoi_stripe_test_api_key" value="<?php echo esc_attr( get_option('hoi_stripe_test_api_key') ); ?>" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Stripe Live API Key</th>
                <td><input type="text" name="hoi_stripe_live_api_key" value="<?php echo esc_attr( get_option('hoi_stripe_live_api_key') ); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
