<?php
require "../../includes/app.php";

use App\Propiedad;
use Intervention\Image\ImageManagerStatic;

estaAutenticado();

$db = conectarDB();

incluirTemplate("header", false, "../../");

// Data para el select de vendedores
$queryVendedores = "SELECT * FROM vendedores";
$vendedores = mysqli_query($db, $queryVendedores);

$errores = Propiedad::getErrores();

$titulo = '';
$precio = '';
$imagen = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
$fecha = date("Y/m/d");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $propiedad = new Propiedad($_POST);

    /* Genero nombre único para la imagen */
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    /* Resize de la imagen si es que el usuario seleccionó imagen */
    if ($_FILES["imagen"]["tmp_name"]) {
        $imagen = ImageManagerStatic::make($_FILES["imagen"]["tmp_name"])->fit(800, 600);
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
        <fieldset>
            <legend>Información general</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripción de la propiedad"><?php echo $descripcion ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input id="habitaciones" name="habitaciones" type="number" min="1" max="9" placeholder="Ej 3" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños:</label>
            <input id="wc" type="number" name="wc" min="1" max="9" placeholder="Ej 3" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input id="estacionamiento" name="estacionamiento" type="number" min="1" max="9" placeholder="Ej 3" value="<?php echo $estacionamiento ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedorId">
                <option value="">-- Seleccione vendedor --</option>

                <?php while ($vendedor = mysqli_fetch_assoc($vendedores)) : ?>
                    <option value="<?php echo $vendedor["id"]; ?>" <?php echo $vendedorId === $vendedor["id"] ? "selected" : ""; ?>><?php echo $vendedor["nombre"] . " " . $vendedor["apellido"];  ?></option>
                <?php endwhile ?>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer", false, "../../");
?>
