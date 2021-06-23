<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<title>Bienes Raíces</title>

	<link rel="stylesheet" href="build/css/app.css" />
</head>

<body>
	<header class="header <?php echo $inicio ? "inicio" : "" ?>">
		<div class="contenedor contenido-header">
			<div class="barra">
				<a class="logo" href="index.php">
					<img src="build/img/logo.svg" alt="logo imagen" />
				</a>

				<div class="mobile-menu">
					<img src="build/img/barras.svg" alt="imagen barras menu" />
				</div>

				<div class="derecha">
					<img class="dark-mode-boton" src="build/img/dark-mode.svg" alt="imagen dark mode" />

					<nav class="navegacion">
						<a href="nosotros.php">Nosotros</a>
						<a href="anuncios.php">Anuncios</a>
						<a href="blog.php">Blog</a>
						<a href="contacto.php">Contacto</a>
					</nav>
				</div>
			</div>

			<?php
			if ($inicio)
				echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>"
			?>
		</div>
	</header>