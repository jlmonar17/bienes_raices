<?php
require "includes/app.php";
incluirTemplate("header", false);
?>

<main class="contenedor seccion">
    <h1>Conoce sobre nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp" />
                <source srcset="build/img/nosotros.jpg" type="image/jpeg" />
                <img src="build/img/nosotros.jpg" alt="imagen nosotros" />
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>25 años de experiencia</blockquote>

            <p>
                Nam leo nisi, consequat convallis nisl malesuada, cursus
                posuere felis. Donec nec justo metus. Morbi eget
                tincidunt sem. Aliquam quis elementum metus. Nam luctus,
                orci ac efficitur scelerisque, augue diam semper magna,
                ut tristique felis dui ut ex. Aliquam semper maximus
                ligula laoreet aliquam. Praesent sed molestie diam, odio
                sem, cursus id malesuada in, varius eget dui.
                Pellentesque nisi enim, elementum nec ultrices et,
                scelerisque ut neque. Cras ipsum tellus, tempor quis
            </p>

            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                sed diam nonumy eirmod tempor invidunt ut labore et
                dolore magna aliquyam erat, sed diam voluptua. At vero
                eos et accusam et justo duo dolores et ea rebum. Stet
                clita kasd gubergren, no sea takimata sanctus est Lorem
                ipsum dolor sit amet.
            </p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="imagen Seguridad" loading="lazy" />

            <h3>Seguridad</h3>
            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                sed diam nonumy eirmod tempor invidunt ut labore et
                dolore magna aliquyam erat, sed diam voluptua. At vero
                eos et accusam et justo duo dolores et ea rebum. Stet
                clita kasd gubergren, no sea takimata sanctus est Lorem
                ipsum dolor sit amet.
            </p>
        </div>

        <div class="icono">
            <img src="build/img/icono2.svg" alt="imagen precio" loading="lazy" />

            <h3>Precio</h3>
            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                sed diam nonumy eirmod tempor invidunt ut labore et
                dolore magna aliquyam erat, sed diam voluptua. At vero
                eos et accusam et justo duo dolores et ea rebum. Stet
                clita kasd gubergren, no sea takimata sanctus est Lorem
                ipsum dolor sit amet.
            </p>
        </div>

        <div class="icono">
            <img src="build/img/icono3.svg" alt="imagen a tiempo" loading="lazy" />

            <h3>A Tiempo</h3>
            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                sed diam nonumy eirmod tempor invidunt ut labore et
                dolore magna aliquyam erat, sed diam voluptua. At vero
                eos et accusam et justo duo dolores et ea rebum. Stet
                clita kasd gubergren, no sea takimata sanctus est Lorem
                ipsum dolor sit amet.
            </p>
        </div>
    </div>
</section>

<?php
incluirTemplate("footer");
?>
