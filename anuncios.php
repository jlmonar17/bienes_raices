<?php
require "includes/app.php";
incluirTemplate("header", false);
?>

<section class="seccion contenedor">
    <h2>Casas y Depas en Venta</h2>

    <div class="contenedor-anuncios">
        <?php
        $limite = 30;
        include "includes/templates/anuncios.php";
        ?>
    </div>
</section>

<?php
incluirTemplate("footer");
?>
