jQuery(document).ready(function ($) {
    $('#clear-cache-button').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'hoi_clear_cache',
            },
            success: function (response) {
                if (response.success) {
                    // Display success message
                    $('#cache-clear-message').html('<div class="notice notice-success is-dismissible"><p>' + response.data + '</p></div>');
                } else {
                    // Handle error
                    $('#cache-clear-message').html('<div class="notice notice-error is-dismissible"><p>Failed to clear cache.</p></div>');
                }
            },
            error: function () {
                $('#cache-clear-message').html('<div class="notice notice-error is-dismissible"><p>Failed to clear cache.</p></div>');
            },
        });
    });
});
