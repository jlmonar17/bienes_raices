<?php
require "../../includes/funciones.php";

$auth = estaAutenticado();

if (!$auth) {
    header("Location: ../../");
}

// Validar el id.
$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: ../index.php");
}

require "../../includes/config/database.php";
$db = conectarDB();

incluirTemplate("header", false, "../../");

// Obtengo los datos de la propiedad.
$queryPropiedad = "SELECT * FROM propiedades WHERE id=${id}";
$resultadoPropiedad = mysqli_query($db, $queryPropiedad);

$propiedad = mysqli_fetch_assoc($resultadoPropiedad);

// Data para el select de vendedores
$queryVendedores = "SELECT * FROM vendedores";
$vendedores = mysqli_query($db, $queryVendedores);

$errores = [];

$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$imagen = "";
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedorId = $propiedad["vendedorId"];
$fecha = date("Y/m/d");
$imagenPropiedad = $propiedad["imagen"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $vendedorId = mysqli_real_escape_string($db, $_POST["vendedorId"]);

    $imagen = $_FILES["imagen"];

    // Validaciones
    if (!$titulo) {
        $errores[] = "El título es requerido";
    }

    if (!$precio) {
        $errores[] = "El precio es requerido";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion es requerida y debe contener al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "Número de habitaciones requerido";
    }

    if (!$wc) {
        $errores[] = "Número de baños requerido";
    }

    if (!$estacionamiento) {
        $errores[] = "Número de estacionamientos requerido";
    }

    if (!$vendedorId) {
        $errores[] = "Vendedor es requerido";
    }

    if ($imagen["size"] > 1000000) {
        $errores[] = "La imagen es muy pesada";
    }


    if (empty($errores)) {
        /* Subida de archivos */

        /* Crear carpeta */
        $carpetaImagenes = "../../imagenes/";

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = "";

        if ($imagen["name"]) {
            /* Elimino imagen previa */
            unlink($carpetaImagenes . $propiedad["imagen"]);

            /* Genero nombre aleatorio */
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            /* Subir archivo */
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad["imagen"];
        }

        $query = "UPDATE propiedades set titulo='$titulo', precio=$precio, imagen='$nombreImagen', descripcion='$descripcion', habitaciones=$habitaciones," .
            "wc=$wc, estacionamiento=$estacionamiento, vendedorId=$vendedorId WHERE id=$id";

        $resultado = mysqli_query($db, $query);

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
        <fieldset>
            <legend>Información general</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
            <img src="../../imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small">

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

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer", false, "../../");
?>
