jQuery(document).ready(function($) {
    $('#clear_cache').on('click', function(e) {
        e.preventDefault();
        var data = {
            'action': 'clear_cache',
        };
        $.post(ajaxurl, data, function(response) {
            var successMessage = $('<div>', {
                text: 'Cache Cleared Successfully',
                class: 'notice notice-success is-dismissible'
            }).prependTo('.wrap');

            setTimeout(function() {
                successMessage.fadeOut();
            }, 3000);
        });
    });
});
