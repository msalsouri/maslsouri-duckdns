document.addEventListener('DOMContentLoaded', function() {
    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            var message = document.getElementById('message');
            if (message) {
                message.remove();
            }
        });
    });
});
