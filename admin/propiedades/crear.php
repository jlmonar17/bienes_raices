<?php
require "../../includes/app.php";

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic;

estaAutenticado();

incluirTemplate("header", false, "../../");

/* Obtengo todos los vendedores */
$vendedores = Vendedor::all();

$errores = Propiedad::getErrores();

$propiedad = new Propiedad();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $propiedad = new Propiedad($_POST["propiedad"]);

    /* Genero nombre único para la imagen */
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    /* Resize de la imagen si es que el usuario seleccionó imagen */
    if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
        $imagen = ImageManagerStatic::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    /* Valido los datos ingresados por el usuario */
    $errores = $propiedad->validar();

    if (empty($errores)) {
        /* Subir imagen */
        /* Crear carpeta  para subir la imagen */
        if (!is_dir(IMAGENES_URL)) {
            mkdir(IMAGENES_URL);
        }

        /* Guardo la imagen en el servidor */
        $imagen->save(IMAGENES_URL . $nombreImagen);

        // Guardo la propiedad en la base de datos
        $resultado = $propiedad->guardar();

        if ($resultado) {
            header("Location: ../?resultado=1");
        }
    }
}
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alert error">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
        <?php include "../../includes/templates/formulario_propiedades.php"; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer", false, "../../");
?>
