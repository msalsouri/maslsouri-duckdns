<div class="wrap">
    <h1>Stripe API Keys</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('ai_content_generator_stripe_settings');
        do_settings_sections('ai-content-generator-stripe');
        submit_button();
        ?>
    </form>
</div>
