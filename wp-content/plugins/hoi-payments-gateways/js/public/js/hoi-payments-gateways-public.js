/**
 * This is the main JavaScript file for the public-facing side of the plugin.
 *
 * @package    Hoi_Payments_Gateways
 * @subpackage Hoi_Payments_Gateways/public/js
 */

/* Add your public-facing JavaScript here */

// Example JavaScript
document.addEventListener('DOMContentLoaded', function() {
    console.log('Hoi Payments Gateways public JavaScript loaded.');

    // Example function to handle button click
    document.querySelectorAll('.hoi-button').forEach(function(button) {
        button.addEventListener('click', function() {
            alert('Hoi button clicked!');
        });
    });
});
