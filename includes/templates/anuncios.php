<?php
require __DIR__ . "/../config/database.php";
$db = conectarDB();

$query = "SELECT * FROM propiedades LIMIT $limite";
$resultado = mysqli_query($db, $query);

?>

<?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
	<div class="anuncio">
		<img src="imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen anuncio" lazy="loading" />

		<div class="contenido-anuncio">
			<h3><?php echo $propiedad["titulo"]; ?></h3>
			<p>
				<?php echo $propiedad["descripcion"]; ?>
			</p>
			<p class="precio"> <?php echo $propiedad["precio"]; ?></p>

			<ul class="iconos-caracteristicas">
				<li>
					<img lazy="loading" src="build/img/icono_wc.svg" alt="imagen wc" />
					<p> <?php echo $propiedad["wc"]; ?></p>
				</li>
				<li>
					<img lazy="loading" src="build/img/icono_estacionamiento.svg" alt="imagen estacionamiento" />
					<p> <?php echo $propiedad["estacionamiento"]; ?></p>
				</li>
				<li>
					<img lazy="loading" src="build/img/icono_dormitorio.svg" alt="imagen dormitorio" />
					<p> <?php echo $propiedad["habitaciones"]; ?></p>
				</li>
			</ul>

			<a class="boton boton-amarillo-block" href="anuncio.php?id=<?php echo $propiedad["id"]; ?>">Ver Propiedad</a>
		</div>
	</div>
<?php endwhile ?>

<?php
mysqli_close($db);
?>
