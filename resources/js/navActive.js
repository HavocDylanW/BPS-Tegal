document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav-link");
    const currentPath = window.location.pathname;

    navLinks.forEach((link) => {
        // Check if the href of the link matches the current path
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("text-[#F09319]"); // Add the active color class
        } else {
            link.classList.remove("text-[#F09319]"); // Ensure only the current link is highlighted
        }
    });
});
