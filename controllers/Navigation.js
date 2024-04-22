document.addEventListener("DOMContentLoaded", function() {
    var currentUrl = window.location.href;
    var navLinks = document.querySelectorAll(".nav a:not(#logo)");

    navLinks.forEach(function(navLink) {
        if (navLink.href === currentUrl) {
            navLink.classList.add("active");
        }
    });
});
