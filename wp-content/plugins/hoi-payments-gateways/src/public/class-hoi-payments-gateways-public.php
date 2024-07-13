<?php
require_once 'path/to/vendor/autoload.php'; // Adjust the path as needed

use Stripe\Stripe;
use Stripe\Charge;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class Hoi_Payments_Gateways_Public {

    private $client;

    public function __construct() {
        add_shortcode('hoi_stripe_payment', array($this, 'render_stripe_payment_form'));
        add_action('wp_ajax_nopriv_process_stripe_payment', array($this, 'process_stripe_payment'));
        add_action('wp_ajax_process_stripe_payment', array($this, 'process_stripe_payment'));

        add_shortcode('hoi_paypal_payment', array($this, 'render_paypal_payment_button'));
        add_action('wp_ajax_nopriv_process_paypal_payment', array($this, 'process_paypal_payment'));
        add_action('wp_ajax_process_paypal_payment', array($this, 'process_paypal_payment'));

        $options = get_option('hoi_payments_gateways_options');
        $environment = new SandboxEnvironment($options['paypal_client_id'], $options['paypal_client_secret']);
        $this->client = new PayPalHttpClient($environment);
    }

    public function render_stripe_payment_form() {
        ob_start();
        ?>
        <form id="stripe-payment-form">
            <input type="text" id="card-holder-name" placeholder="Card Holder Name">
            <div id="card-element"></div>
            <button id="card-button" data-secret="<?= $intent->client_secret ?>">Pay</button>
        </form>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe('your-publishable-key-here');
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');
        </script>
        <?php
        return ob_get_clean();
    }

    public function process_stripe_payment() {
        check_ajax_referer('process_stripe_payment', 'security');

        $options = get_option('hoi_payments_gateways_options');
        Stripe::setApiKey($options['stripe_api_secret']);

        $token = ['stripeToken'];
        $charge = Charge::create([
            'amount' => 1000, // Amount in cents
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);

        if ($charge->status == 'succeeded') {
            wp_send_json_success('Payment successful');
        } else {
            wp_send_json_error('Payment failed');
        }
    }

    public function render_paypal_payment_button() {
        ob_start();
        ?>
        <div id="paypal-button-container"></div>
        <script src="https://www.paypal.com/sdk/js?client-id=your-client-id"></script>
        <script>
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '10.00' // Can dynamically set the value here
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });
                }
            }).render('#paypal-button-container');
        </script>
        <?php
        return ob_get_clean();
    }

    public function process_paypal_payment() {
        check_ajax_referer('process_paypal_payment', 'security');

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'value' => '10.00',
                    'currency_code' => 'USD'
                ]
            ]],
        ];

        try {
            $response = $this->client->execute($request);
            wp_send_json_success($response->result);
        } catch (HttpException $ex) {
            wp_send_json_error($ex->getMessage());
        }
    }
}
?>
