<?php
// Function to create a new page
function create_new_page() {
    $new_page = array(
        'post_title'    => 'My New Page',
        'post_content'  => 'This is the content of my new page.',
        'post_status'   => 'publish',
        'post_type'     => 'page',
    );

    // Insert the page into the database
    $page_id = wp_insert_post($new_page);

    if (is_wp_error($page_id)) {
        return 'Failed to create new page: ' . $page_id->get_error_message();
    } else {
        return 'New page created successfully with ID: ' . $page_id;
    }
}

// Function to create a new post
function create_new_post() {
    $new_post = array(
        'post_title'    => 'My New Post',
        'post_content'  => 'This is the content of my new post.',
        'post_status'   => 'publish',
        'post_type'     => 'post',
    );

    // Insert the post into the database
    $post_id = wp_insert_post($new_post);

    if (is_wp_error($post_id)) {
        return 'Failed to create new post: ' . $post_id->get_error_message();
    } else {
        return 'New post created successfully with ID: ' . $post_id;
    }
}

// Handle button click event to create page or post
function handle_creation_request() {
    if (isset($_POST['create_page'])) {
        $message = create_new_page();
        add_action('admin_notices', function() use ($message) {
            echo '<div class="notice notice-success is-dismissible"><p>' . $message . '</p></div>';
        });
    }

    if (isset($_POST['create_post'])) {
        $message = create_new_post();
        add_action('admin_notices', function() use ($message) {
            echo '<div class="notice notice-success is-dismissible"><p>' . $message . '</p></div>';
        });
    }
}
add_action('admin_init', 'handle_creation_request');
