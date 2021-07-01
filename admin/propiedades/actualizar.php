<?php
require "../../includes/app.php";

use App\Propiedad;
use Intervention\Image\ImageManagerStatic;

estaAutenticado();

// Validar el id.
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: ../index.php");
}

$db = conectarDB();

incluirTemplate("header", false, "../../");

// Obtengo los datos de la propiedad.
$propiedad = Propiedad::find($id);

// Data para el select de vendedores
$queryVendedores = "SELECT * FROM vendedores";
$vendedores = mysqli_query($db, $queryVendedores);

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $args = $_POST["propiedad"];

    $propiedad->sincronizar($args);

    // Validaciones
    $errores = $propiedad->validar();

    if (empty($errores)) {
        /* Subida de archivos */
        /* Crear carpeta  para subir la imagen */
        if (!is_dir(IMAGENES_URL)) {
            mkdir(IMAGENES_URL);
        }

        /* Genero nombre único para la imagen */
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        /* Resize de la imagen si es que el usuario seleccionó imagen */
        if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            $imagen = ImageManagerStatic::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);

            /* Guardo la imagen en el servidor */
            $imagen->save(IMAGENES_URL . $nombreImagen);
        }

        $resultado = $propiedad->guardar();

        if ($resultado) {
            header("Location: ../?resultado=2");
        }
    }
}
?>

<main class="contenedor seccion">
    <h1>Actualizar</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alert error">
            <?php echo $error ?>
        </div>
    <?php endforeach ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include "../../includes/templates/formulario_propiedades.php"; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer", false, "../../");
?>
