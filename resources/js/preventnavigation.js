document.addEventListener('DOMContentLoaded', function() {
    // Prevent going back to previous pages after authentication
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.pushState(null, null, location.href);
    };

    // Disable browser back button functionality
    window.onload = function() {
        window.history.forward();
    };

    // Prevent caching
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
});