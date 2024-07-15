<?php
/**
 * Plugin Name: HOI AI Content Generator
 * Plugin URI:  https://hoiltd.com.com
 * Description: A plugin to generate content and provide SEO suggestions using AI.
 * Version:     1.0
 * Author:      MOHAMMAD AL-SOURI
 * Author URI:  https://msalsouri.github.io
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: hoi-ai-content-generator
 * Domain Path: /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Section: Admin Menu
 * Description: Adds a menu item to the WordPress admin dashboard for the plugin.
 */
add_action('admin_menu', 'ai_content_generator_menu');

function ai_content_generator_menu() {
    add_menu_page('AI Content Generator', 'AI Content Generator', 'manage_options', 'ai-content-generator', 'ai_content_generator_page');
    add_submenu_page('ai-content-generator', 'Settings', 'Settings', 'manage_options', 'ai-content-generator-settings', 'ai_content_generator_settings_page');
}

/**
 * Section: Main Plugin Page
 * Description: The main page of the plugin where users can generate content and get SEO suggestions.
 */
function ai_content_generator_page() {
    // Buffer output to prevent premature header output.
    ob_start();
    ?>
    <div class="wrap">
        <h1>AI Content Generator</h1>
        <form method="post" action="">
            <h2>Generate Content</h2>
            <p>Enter a topic and generate content using AI.</p>
            <label for="content_topic">Topic:</label>
            <input type="text" name="content_topic" id="content_topic" style="width: 100%;">
            <br><br>
            <input type="submit" name="generate_content" value="Generate Content">
            <hr>
            <h2>SEO Suggestions</h2>
            <p>Enter content and get SEO suggestions using AI.</p>
            <label for="seo_content">Content:</label>
            <textarea name="seo_content" id="seo_content" rows="5" cols="50" style="width: 100%;"></textarea>
            <br><br>
            <input type="submit" name="get_seo_suggestions" value="Get SEO Suggestions">
        </form>
        <?php
        // Handle form submissions for generating content and SEO suggestions
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
    </div>
    <?php
    // Send the output buffer.
    ob_end_flush();
}

/**
 * Section: Settings Page
 * Description: The settings page for the plugin where users can set the API key.
 */
function ai_content_generator_settings_page() {
    // Buffer output to prevent premature header output.
    ob_start();
    ?>
    <div class="wrap">
        <h1>AI Content Generator Settings</h1>
        <form method="post" action="options.php">
            <?php
            // Output settings fields and sections
            settings_fields('ai_content_generator_settings');
            do_settings_sections('ai-content-generator-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
    // Send the output buffer.
    ob_end_flush();
}

// Initialize plugin settings
add_action('admin_init', 'ai_content_generator_settings_init');

function ai_content_generator_settings_init() {
    // Add settings section
    add_settings_section(
        'ai_content_generator_section',
        'API Settings',
        'ai_content_generator_section_callback',
        'ai-content-generator-settings'
    );

    // Add settings field for API key
    add_settings_field(
        'ai_content_generator_api_key',
        'API Key',
        'ai_content_generator_api_key_callback',
        'ai-content-generator-settings',
        'ai_content_generator_section'
    );

    // Register settings
    register_setting('ai_content_generator_settings', 'ai_content_generator_api_key');
}

function ai_content_generator_section_callback() {
    echo 'Enter your API key for the AI Content Generator.';
}

function ai_content_generator_api_key_callback() {
    $api_key = get_option('ai_content_generator_api_key');
    echo '<input type="text" name="ai_content_generator_api_key" value="' . esc_attr($api_key) . '" style="width: 100%;" />';
}

/**
 * Section: AI Functions
 * Description: Functions to generate content and provide SEO suggestions using the AI API.
 */
function ai_generate_content($topic) {
    $api_key = get_option('ai_content_generator_api_key');
    if (!$api_key) {
        return 'API key not set. Please configure it in the plugin settings.';
    }

    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $data = array(
        'prompt' => "Generate content about the following topic: $topic",
        'max_tokens' => 150
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $api_key\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { return "Error generating content."; }

    $response = json_decode($result, true);
    return isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : "Error: No response from AI.";
}

function ai_get_seo_suggestions($content) {
    $api_key = get_option('ai_content_generator_api_key');
    if (!$api_key) {
        return 'API key not set. Please configure it in the plugin settings.';
    }

    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $data = array(
        'prompt' => "Provide SEO suggestions for the following content: $content",
        'max_tokens' => 150
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $api_key\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { return "Error generating SEO suggestions."; }

    $response = json_decode($result, true);
    return isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : "Error: No response from AI.";
}

/**
 * Section: Additional Functions (Uncommented)
 * Description: Placeholder functions for future expansion.
 */

// Uncomment and integrate the following functions as needed for additional features

// Function to generate meta tags
function ai_generate_meta_tags($content) {
    $api_key = get_option('ai_content_generator_api_key');
    if (!$api_key) {
        return 'API key not set. Please configure it in the plugin settings.';
    }

    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $data = array(
        'prompt' => "Generate meta tags for the following content: $content",
        'max_tokens' => 60
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $api_key\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { return "Error generating meta tags."; }

    $response = json_decode($result, true);
    return isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : "Error: No response from AI.";
}

// Function to generate post titles
function ai_generate_post_titles($content) {
    $api_key = get_option('ai_content_generator_api_key');
    if (!$api_key) {
        return 'API key not set. Please configure it in the plugin settings.';
    }

    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $data = array(
        'prompt' => "Generate SEO-friendly post titles for the following content: $content",
        'max_tokens' => 60
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $api_key\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { return "Error generating post titles."; }

    $response = json_decode($result, true);
    return isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : "Error: No response from AI.";
}

// Function to suggest internal links
function ai_suggest_internal_links($content) {
    $api_key = get_option('ai_content_generator_api_key');
    if (!$api_key) {
        return 'API key not set. Please configure it in the plugin settings.';
    }

    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $data = array(
        'prompt' => "Suggest internal links for the following content: $content",
        'max_tokens' => 60
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $api_key\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { return "Error suggesting internal links."; }

    $response = json_decode($result, true);
    return isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : "Error: No response from AI.";
}

// Function to analyze content readability
function ai_analyze_content_readability($content) {
    $api_key = get_option('ai_content_generator_api_key');
    if (!$api_key) {
        return 'API key not set. Please configure it in the plugin settings.';
    }

    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $data = array(
        'prompt' => "Analyze the readability of the following content: $content",
        'max_tokens' => 60
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $api_key\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { return "Error analyzing content readability."; }

    $response = json_decode($result, true);
    return isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : "Error: No response from AI.";
}

// Function to provide content outline
function ai_provide_content_outline($topic) {
    $api_key = get_option('ai_content_generator_api_key');
    if (!$api_key) {
        return 'API key not set. Please configure it in the plugin settings.';
    }

    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';
    
    $data = array(
        'prompt' => "Provide a detailed outline for the following topic: $topic",
        'max_tokens' => 60
    );
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n" .
                         "Authorization: Bearer $api_key\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { return "Error providing content outline."; }

    $response = json_decode($result, true);
    return isset($response['choices'][0]['text']) ? $response['choices'][0]['text'] : "Error: No response from AI.";
}

// No closing PHP tag to avoid accidental whitespace



