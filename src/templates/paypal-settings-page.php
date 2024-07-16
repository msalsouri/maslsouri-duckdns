<div class="wrap">
    <h1>PayPal API Keys</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('ai_content_generator_paypal_settings');
        do_settings_sections('ai-content-generator-paypal');
        submit_button();
        ?>
    </form>
</div>
