<?php
require "../includes/config/database.php";
$db = conectarDB();

$query = "SELECT * FROM propiedades;";

$resultadoConsulta = mysqli_query($db, $query);

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
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad["id"]; ?></td>
                    <td><?php echo $propiedad["titulo"]; ?></td>
                    <td>
                        <img class="imagen-table" src="../imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen propiedad">
                    </td>
                    <td>$ <?php echo $propiedad["precio"]; ?></td>
                    <td>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="#" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</main>

<?php
mysqli_close($db);

incluirTemplate("footer", false, "../");
?>
