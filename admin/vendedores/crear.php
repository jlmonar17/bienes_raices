<?php
require "../../includes/app.php";

use App\Vendedor;

estaAutenticado();

incluirTemplate("header", false, "../../");

$errores = Vendedor::getErrores();

$vendedor = new Vendedor();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $vendedor = new Vendedor($_POST["vendedor"]);

    /* Valido los datos ingresados por el usuario */
    $errores = $vendedor->validar();

    if (empty($errores)) {
        // Guardo al vendedor en la base de datos
        $resultado = $vendedor->guardar();

        if ($resultado) {
            header("Location: ../?resultado=1");
        }
    }
}
?>

<main class="contenedor seccion">
    <h1>Nuevo(a) Vendedor</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alert error">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST" action="crear.php">
        <?php include "../../includes/templates/formulario_vendedores.php"; ?>

        <input type="submit" value="Crear Vendedor" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer", false, "../../");
?>
