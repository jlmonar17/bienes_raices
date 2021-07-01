<?php
require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();

// Validar el id.
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: ../index.php");
}

incluirTemplate("header", false, "../../");

$vendedor = Vendedor::find($id);

$errores = Vendedor::getErrores();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $args = $_POST["vendedor"];

    $vendedor->sincronizar($args);

    $errores = $vendedor->validar();

    if (empty($errores)) {
        $resultado = $vendedor->guardar();

        if ($resultado) {
            header("Location: ../?resultado=2");
        }
    }
}
?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alert error">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST">
        <?php include "../../includes/templates/formulario_vendedores.php"; ?>

        <input type="submit" value="Guardar cambios" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer", false, "../../");
?>
