document.addEventListener("DOMContentLoaded", function () {
    eventListeners();

    toggleDarkMode();
});

function eventListeners() {
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsiva);
}

function navegacionResponsiva() {
    const navegacion = document.querySelector(".navegacion");

    navegacion.classList.toggle("mostrar");
}

function toggleDarkMode() {
    const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

    if (prefiereDarkMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }

    prefiereDarkMode.addEventListener("change", function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }
    });

    const darkModeBoton = document.querySelector(".dark-mode-boton");

    darkModeBoton.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
    });
}
