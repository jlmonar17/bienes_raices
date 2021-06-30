<?php

require "includes/app.php";
$db = conectarDB();

$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
}

$query = "SELECT * FROM propiedades WHERE id=$id";
$resultado = mysqli_query($db, $query);

if ($resultado->num_rows === 0) {
    header("Location: index.php");
}

$propiedad = mysqli_fetch_assoc($resultado);

incluirTemplate("header", false);
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad["titulo"]; ?></h1>

    <div class="imagen">
        <img loading="lazy" src="imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen anuncio" />

        <div class="contenido-anuncio">
            <p class="precio">$ <?php echo $propiedad["precio"]; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img lazy="loading" src="build/img/icono_wc.svg" alt="imagen wc" />
                    <p><?php echo $propiedad["wc"]; ?></p>
                </li>
                <li>
                    <img lazy="loading" src="build/img/icono_estacionamiento.svg" alt="imagen estacionamiento" />
                    <p><?php echo $propiedad["estacionamiento"]; ?></p>
                </li>
                <li>
                    <img lazy="loading" src="build/img/icono_dormitorio.svg" alt="imagen dormitorio" />
                    <p><?php echo $propiedad["habitaciones"]; ?></p>
                </li>
            </ul>

            <p>
                <?php echo $propiedad["descripcion"]; ?>
            </p>

            <br />

            <p>
                <?php echo $propiedad["descripcion"]; ?>
            </p>
        </div>
    </div>
</main>

<?php
mysqli_close($db);

include("includes/templates/footer.php");
?>
