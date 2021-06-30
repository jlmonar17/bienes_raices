<?php

require "../includes/app.php";

use App\Propiedad;

estaAutenticado();

/* Obtengo todas las proiedades */
$propiedades = Propiedad::all();

incluirTemplate("header", false, "../");

/* Eliminar propiedad */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        /* Elimino imagen primero */
        $queryPropiedad = "SELECT * FROM propiedades WHERE id=$id";
        $resultadoPropiedad = mysqli_query($db, $queryPropiedad);
        $propiedad = mysqli_fetch_assoc($resultadoPropiedad);

        unlink("../imagenes/" . $propiedad["imagen"]);

        /* Elimino el registro de la base de datos */
        $queryPropiedadEliminar = "DELETE FROM propiedades WHERE id=$id";
        $resultadoPropiedadEliminar = mysqli_query($db, $queryPropiedadEliminar);

        if ($resultadoPropiedadEliminar) {
            header("Location: ../admin?resultado=3");
        }
    }
}

$resultado = $_GET["resultado"] ?? null;
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if (intval($resultado) === 1) : ?>
        <p class="alert exito">Anuncio creado correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alert exito">Anuncio actualizado correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alert exito">Anuncio eliminado correctamente</p>
    <?php endif ?>

    <a href="propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>
                        <img class="imagen-table" src="../imagenes/<?php echo $propiedad->imagen; ?>">
                    </td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo  $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</main>

<?php
mysqli_close($db);

incluirTemplate("footer", false, "../");
?>
