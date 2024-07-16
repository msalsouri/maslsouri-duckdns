<div class="wrap">
    <h1 class="text-2xl font-bold mb-4">AI Content Generator</h1>
    <form method="post" action="" class="space-y-4">
        <div>
            <h2 class="text-xl font-semibold">Generate Content</h2>
            <p>Enter a topic and generate content using AI.</p>
            <label for="content_topic" class="block text-sm font-medium text-gray-700">Topic:</label>
            <input type="text" name="content_topic" id="content_topic" class="w-full p-2 border border-gray-300 rounded-md">
            <br><br>
            <input type="submit" name="generate_content" value="Generate Content" class="bg-blue-500 text-white px-4 py-2 rounded-md">
        </div>
        <hr>
        <div>
            <h2 class="text-xl font-semibold">SEO Suggestions</h2>
            <p>Enter content and get SEO suggestions using AI.</p>
            <label for="seo_content" class="block text-sm font-medium text-gray-700">Content:</label>
            <textarea name="seo_content" id="seo_content" rows="5" class="w-full p-2 border border-gray-300 rounded-md"></textarea>
            <br><br>
            <input type="submit" name="get_seo_suggestions" value="Get SEO Suggestions" class="bg-blue-500 text-white px-4 py-2 rounded-md">
        </div>
    </form>
    <?php
    if (isset($_POST['generate_content'])) {
        $content = ai_generate_content(sanitize_text_field($_POST['content_topic']));
        echo '<div class="mt-4"><h2 class="text-xl font-semibold">Generated Content</h2>';
        echo '<pre class="bg-gray-100 p-4 rounded-md">' . esc_html($content) . '</pre></div>';
    }

    if (isset($_POST['get_seo_suggestions'])) {
        $seo_suggestions = ai_get_seo_suggestions(sanitize_textarea_field($_POST['seo_content']));
        echo '<div class="mt-4"><h2 class="text-xl font-semibold">SEO Suggestions</h2>';
        echo '<pre class="bg-gray-100 p-4 rounded-md">' . esc_html($seo_suggestions) . '</pre></div>';
    }
    ?>
    <div id="cache-clear-message" class="mt-4"></div>
    <button id="clear-cache-button" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4">Clear Cache</button>
    <hr class="my-4">
    <h2 class="text-xl font-semibold">Webhook Setup</h2>
    <p>To set up a webhook, use the following URL:</p>
    <code class="block bg-gray-100 p-2 rounded-md mb-4">https://yourwebsite.com/webhook-endpoint</code>
    <p>Ensure your webhook can handle the following events:</p>
    <ul class="list-disc list-inside bg-gray-100 p-4 rounded-md">
        <li><strong>Event 1:</strong> Description of Event 1</li>
        <li><strong>Event 2:</strong> Description of Event 2</li>
        <li><strong>Event 3:</strong> Description of Event 3</li>
    </ul>
</div>
