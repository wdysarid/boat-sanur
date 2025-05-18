import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.getElementById("navbar");
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    // Navbar background change on scroll
    window.addEventListener("scroll", () => {
        if (window.scrollY > 10) {
            navbar.classList.remove("bg-transparent");
            navbar.classList.add("bg-[#30A2FF]", "shadow-md");
        } else {
            navbar.classList.remove("bg-[#30A2FF]", "shadow-md");
            navbar.classList.add("bg-transparent");
        }
    });

    // Toggle mobile menu
    menuBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
});
