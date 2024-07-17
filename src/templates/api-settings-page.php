<div class="wrap">
    <h1>API Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields('hoi-api-settings-group'); ?>
        <?php do_settings_sections('hoi-api-settings-group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">API Key</th>
                <td><input type="text" name="hoi_api_key" value="<?php echo esc_attr(get_option('hoi_api_key')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
