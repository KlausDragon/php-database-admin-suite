document.addEventListener("DOMContentLoaded", function () {
    const switchButton = document.querySelector(".switch");
    const body = document.body;

    // By default, set dark mode
    body.classList.add("dark-mode");

    // Toggle the theme when the switch is changed
    switchButton.addEventListener("change", function () {
        body.classList.toggle("light-mode");
        body.classList.toggle("dark-mode");
    });
});