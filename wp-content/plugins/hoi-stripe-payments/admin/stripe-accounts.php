<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function add_multi_account_settings() {
    register_setting('stripe-accounts-group', 'stripe_accounts', 'sanitize_accounts');

    add_settings_section('stripe-accounts-section', __('Stripe Accounts', 'stripe-payments'), null, 'stripe-accounts');

    add_settings_field(
        'stripe_accounts',
        __('Manage Stripe Accounts', 'stripe-payments'),
        'stripe_accounts_callback',
        'stripe-accounts',
        'stripe-accounts-section'
    );
}

function sanitize_accounts($input) {
    $accounts = array();
    foreach ($input['account_name'] as $key => $name) {
        if (!empty($name) && !empty($input['api_secret_key'][$key]) && !empty($input['api_publishable_key'][$key])) {
            $accounts[] = array(
                'account_name' => sanitize_text_field($name),
                'api_secret_key' => sanitize_text_field($input['api_secret_key'][$key]),
                'api_publishable_key' => sanitize_text_field($input['api_publishable_key'][$key]),
            );
        }
    }
    return $accounts;
}

function stripe_accounts_callback() {
    $accounts = get_option('stripe_accounts', array());
    ?>
    <div id="stripe-accounts">
        <?php foreach ($accounts as $index => $account) : ?>
            <div class="stripe-account">
                <input type="text" name="stripe_accounts[account_name][]" value="<?php echo esc_attr($account['account_name']); ?>" placeholder="Account Name" />
                <input type="text" name="stripe_accounts[api_secret_key][]" value="<?php echo esc_attr($account['api_secret_key']); ?>" placeholder="Secret Key" />
                <input type="text" name="stripe_accounts[api_publishable_key][]" value="<?php echo esc_attr($account['api_publishable_key']); ?>" placeholder="Publishable Key" />
                <button type="button" class="remove-account">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-account">Add Account</button>
    <script>
        jQuery(document).ready(function($) {
            $('#add-account').on('click', function() {
                $('#stripe-accounts').append('<div class="stripe-account">' +
                    '<input type="text" name="stripe_accounts[account_name][]" placeholder="Account Name" />' +
                    '<input type="text" name="stripe_accounts[api_secret_key][]" placeholder="Secret Key" />' +
                    '<input type="text" name="stripe_accounts[api_publishable_key][]" placeholder="Publishable Key" />' +
                    '<button type="button" class="remove-account">Remove</button>' +
                    '</div>');
            });
            $('#stripe-accounts').on('click', '.remove-account', function() {
                $(this).parent('.stripe-account').remove();
            });
        });
    </script>
    <?php
}

add_action('admin_init', 'add_multi_account_settings');
?>

