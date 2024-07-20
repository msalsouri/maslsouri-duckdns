<div class="wrap max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Stripe Settings</h1>
    <form method="post" action="options.php" class="space-y-6">
        <?php settings_fields('hoi_stripe_settings_group'); ?>
        <?php do_settings_sections('hoi_stripe_settings_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Stripe Test API Key</th>
                <td><input type="text" name="hoi_stripe_test_api_key" value="<?php echo esc_attr(get_option('hoi_stripe_test_api_key')); ?>" class="w-full p-3 border border-gray-300 rounded-lg" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Stripe Live API Key</th>
                <td><input type="text" name="hoi_stripe_live_api_key" value="<?php echo esc_attr(get_option('hoi_stripe_live_api_key')); ?>" class="w-full p-3 border border-gray-300 rounded-lg" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
