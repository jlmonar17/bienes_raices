<?php

use App\Propiedad;


if ($_SERVER["REQUEST_URI"] === "/curso_desarrollo_web_completo/bienes_raices/anuncios.php") {
	$propiedades = Propiedad::all();
} else {
	$propiedades = Propiedad::get(3);
}

?>

<?php foreach ($propiedades as $propiedad) : ?>
	<div class="anuncio">
		<img src="imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen anuncio" lazy="loading" />

		<div class="contenido-anuncio">
			<h3><?php echo $propiedad->titulo; ?></h3>
			<p>
				<?php echo $propiedad->descripcion; ?>
			</p>
			<p class="precio"> <?php echo $propiedad->precio; ?></p>

			<ul class="iconos-caracteristicas">
				<li>
					<img lazy="loading" src="build/img/icono_wc.svg" alt="imagen wc" />
					<p> <?php echo $propiedad->wc; ?></p>
				</li>
				<li>
					<img lazy="loading" src="build/img/icono_estacionamiento.svg" alt="imagen estacionamiento" />
					<p> <?php echo $propiedad->estacionamiento; ?></p>
				</li>
				<li>
					<img lazy="loading" src="build/img/icono_dormitorio.svg" alt="imagen dormitorio" />
					<p> <?php echo $propiedad->habitaciones; ?></p>
				</li>
			</ul>

			<a class="boton boton-amarillo-block" href="anuncio.php?id=<?php echo $propiedad->id; ?>">Ver Propiedad</a>
		</div>
	</div>
<?php endforeach ?>
