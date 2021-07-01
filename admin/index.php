<?php

require "../includes/app.php";

use App\Propiedad;
use App\Vendedor;

estaAutenticado();

/* Obtengo todas las proiedades */
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

incluirTemplate("header", false, "../");

/* Eliminar propiedad */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        $tipo = $_POST["tipo"];
        $resultado = null;

        if (validarTipoContenido($tipo)) {
            if ($tipo === "propiedad") {
                $propiedad = Propiedad::find($id);
                $resultado = $propiedad->eliminar();

                if ($resultado) {
                    $propiedad->borrarImagen();

                    header("Location: ../admin?resultado=3");
                }
            } elseif ($tipo === "vendedor") {
                $vendedor = Vendedor::find($id);
                $resultado = $vendedor->eliminar();

                if ($resultado) {
                    $vendedor->borrarImagen();

                    header("Location: ../admin?resultado=3");
                }
            }
        }
    }
}

$resultado = $_GET["resultado"] ?? null;
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php
    $mensaje = mostrarNotificacion(intval($resultado));
    if ($mensaje) : ?>
        <p class="alert exito"><?php echo sanitizar($mensaje); ?></p>
    <?php endif;    ?>

    <a href="propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
    <a href="vendedores/crear.php" class="boton boton-amarillo">Nuevo(a) vendedor</a>

    <h2>Propiedades</h2>

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
                            <input type="hidden" name="tipo" value="propiedad">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?php echo  $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="vendedores/actualizar.php?id=<?php echo  $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
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
