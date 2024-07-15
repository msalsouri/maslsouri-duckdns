<?php

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
