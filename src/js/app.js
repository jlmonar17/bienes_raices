document.addEventListener("DOMContentLoaded", function () {
    eventListeners();
});

function eventListeners() {
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsiva);
}

function navegacionResponsiva() {
    const navegacion = document.querySelector(".navegacion");

    navegacion.classList.toggle("mostrar");
}
