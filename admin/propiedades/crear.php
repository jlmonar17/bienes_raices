<?php
require "../../includes/funciones.php";
incluirTemplate("header", false, "../../");
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <form class="formulario">
        <fieldset>
            <legend>Información general</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio propiedad">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" placeholder="Descripción de la propiedad"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input id="habitaciones" type="number" min="1" max="9" placeholder="Ej 3">

            <label for="banios">Baños:</label>
            <input id="banios" type="number" min="1" max="9" placeholder="Ej 3">

            <label for="estacionamiento">Estacionamiento:</label>
            <input id="estacionamiento" type="number" min="1" max="9" placeholder="Ej 3">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select>
                <option value="1">Juan</option>
                <option value="2">Carlos</option>
            </select>
        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer", false, "../../");
?>
