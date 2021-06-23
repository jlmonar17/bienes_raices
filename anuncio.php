<?php
require "includes/funciones.php";
incluirTemplate("header", false);
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en venta frente al bosque</h1>

    <div class="imagen">
        <picture>
            <source srcset="build/img/anuncio1.webp" type="image/webp" />
            <source srcset="build/img/anuncio1.jpg" type="image/jpeg" />
            <img loading="lazy" src="build/img/anuncio1.jpg" alt="imagen anuncio playa" />
        </picture>

        <div class="contenido-anuncio">
            <p class="precio">3,000,000</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img lazy="loading" src="build/img/icono_wc.svg" alt="imagen wc" />
                    <p>3</p>
                </li>
                <li>
                    <img lazy="loading" src="build/img/icono_estacionamiento.svg" alt="imagen estacionamiento" />
                    <p>3</p>
                </li>
                <li>
                    <img lazy="loading" src="build/img/icono_dormitorio.svg" alt="imagen dormitorio" />
                    <p>4</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                sed diam nonumy eirmod tempor invidunt ut labore et
                dolore magna aliquyam erat, sed diam voluptua. At vero
                eos et accusam et justo duo dolores et ea rebum. Stet
                clita kasd gubergren, no sea takimata sanctus est Lorem
                ipsum dolor sit amet.
            </p>

            <br />

            <p>
                Nam leo nisi, consequat convallis nisl malesuada, cursus
                posuere felis. Donec nec justo metus. Morbi eget
                tincidunt sem. Aliquam quis elementum metus. Nam luctus,
                orci ac efficitur scelerisque, augue diam semper magna,
                ut tristique felis dui ut ex. Aliquam semper maximus
                ligula laoreet aliquam. Praesent sed molestie diam,
                ultrices mattis nibh. Praesent id tortor risus. Etiam
                odio sem, cursus id malesuada in, varius eget dui.
                Pellentesque nisi enim, elementum nec ultrices et,
                scelerisque ut neque. Cras ipsum tellus, tempor quis
                convallis et, ultrices consectetur elit. Sed mi quam,
                imperdiet nec suscipit non, placerat sit amet nunc.
                Aliquam semper, massa a sollicitudin pretium, erat
                lectus tristique nisi, a faucibus ex dui a ipsum.
            </p>
        </div>
    </div>
</main>

<?php
include("includes/templates/footer.php");
?>
