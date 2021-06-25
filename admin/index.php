<?php
require "../includes/funciones.php";
incluirTemplate("header", false, "../");

$resultado = $_GET["resultado"] ?? null;
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alert exito">Anuncio creado correctamente</p>
    <?php endif ?>

    <a href="propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
</main>

<?php
incluirTemplate("footer", false, "../");
?>
