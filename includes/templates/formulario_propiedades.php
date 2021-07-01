<fieldset>
	<legend>Información general</legend>

	<label for="titulo">Titulo:</label>
	<input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo sanitizar($propiedad->titulo) ?>">

	<label for="precio">Precio:</label>
	<input type="number" id="precio" name="propiedad[precio]" placeholder="Precio propiedad" value="<?php echo sanitizar($propiedad->precio) ?>">

	<label for="imagen">Imagen:</label>
	<input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">
	<?php if ($propiedad->imagen) : ?>
		<img src="../../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">
	<?php endif ?>

	<label for="descripcion">Descripcion:</label>
	<textarea id="descripcion" name="propiedad[descripcion]" placeholder="Descripción de la propiedad"><?php echo sanitizar($propiedad->descripcion) ?></textarea>
</fieldset>

<fieldset>
	<legend>Información Propiedad</legend>

	<label for="habitaciones">Habitaciones:</label>
	<input id="habitaciones" name="propiedad[habitaciones]" type="number" min="1" max="9" placeholder="Ej 3" value="<?php echo sanitizar($propiedad->habitaciones) ?>">

	<label for="wc">Baños:</label>
	<input id="wc" type="number" name="propiedad[wc]" min="1" max="9" placeholder="Ej 3" value="<?php echo sanitizar($propiedad->wc) ?>">

	<label for="estacionamiento">Estacionamiento:</label>
	<input id="estacionamiento" name="propiedad[estacionamiento]" type="number" min="1" max="9" placeholder="Ej 3" value="<?php echo sanitizar($propiedad->estacionamiento) ?>">
</fieldset>

<fieldset>
	<legend>Vendedor</legend>

	<label for="vendedor">Vendedor</label>

	<select name="propiedad[vendedorId]" id="vendedor">
		<option value="">-- Seleccione vendedor --</option>

		<?php foreach ($vendedores as $vendedor) : ?>
			<option value="<?php echo sanitizar($vendedor->id); ?>" <?php echo $propiedad->vendedorId === $vendedor->id ? "selected" : ""; ?>><?php echo $vendedor->nombre . " " . $vendedor->apellido;  ?></option>
		<?php endforeach ?>
	</select>
</fieldset>
