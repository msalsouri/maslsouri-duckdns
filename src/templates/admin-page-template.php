<div class="wrap">
    <h1>AI Content Generator</h1>
    <form method="post" action="">
        <h2>Generate Content</h2>
        <p>Enter a topic and generate content using AI.</p>
        <label for="content_topic">Topic:</label>
        <input type="text" name="content_topic" id="content_topic" class="input">
        <br><br>
        <input type="submit" name="generate_content" value="Generate Content" class="button button-primary">
        <hr>
        <h2>SEO Suggestions</h2>
        <p>Enter content and get SEO suggestions using AI.</p>
        <label for="seo_content">Content:</label>
        <textarea name="seo_content" id="seo_content" rows="5" class="textarea"></textarea>
        <br><br>
        <input type="submit" name="get_seo_suggestions" value="Get SEO Suggestions" class="button button-primary">
    </form>
    <?php
    if (isset($_POST['generate_content'])) {
        $content = ai_generate_content(sanitize_text_field($_POST['content_topic']));
        echo '<h2>Generated Content</h2>';
        echo '<pre>' . esc_html($content) . '</pre>';
    }

    if (isset($_POST['get_seo_suggestions'])) {
        $seo_suggestions = ai_get_seo_suggestions(sanitize_textarea_field($_POST['seo_content']));
        echo '<h2>SEO Suggestions</h2>';
        echo '<pre>' . esc_html($seo_suggestions) . '</pre>';
    }
    ?>
    <div id="cache-clear-message"></div>
    <button id="clear-cache-button" class="button button-primary">Clear Cache</button>
    <hr>
    <h2>Admin Actions</h2>
    <h3>Webhook Setup</h3>
    <div class="webhook-info">
        <p>To set up a webhook, use the following URL:</p>
        <p><code>https://yourwebsite.com/webhook-endpoint</code></p>
        <p>Ensure your webhook can handle the following events:</p>
        <ul>
            <li><strong>Event 1:</strong> Description of Event 1</li>
            <li><strong>Event 2:</strong> Description of Event 2</li>
            <li><strong>Event 3:</strong> Description of Event 3</li>
        </ul>
    </div>
</div>
