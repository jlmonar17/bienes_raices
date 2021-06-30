<?php
if (!isset($_SESSION)) {
	session_start();
}

$auth = $_SESSION["login"] ?? false;
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<title>Bienes Raíces</title>

	<link rel="stylesheet" href="<?php echo $rutaBuild ?>build/css/app.css" />
</head>

<body>
	<header class="header <?php echo $inicio ? "inicio" : "" ?>">
		<div class="contenedor contenido-header">
			<div class="barra">
				<a class="logo" href="index.php">
					<img src="<?php echo $rutaBuild ?>build/img/logo.svg" alt="logo imagen" />
				</a>

				<div class="mobile-menu">
					<img src="<?php echo $rutaBuild ?>build/img/barras.svg" alt="imagen barras menu" />
				</div>

				<div class="derecha">
					<img class="dark-mode-boton" src="<?php echo $rutaBuild ?>build/img/dark-mode.svg" alt="imagen dark mode" />

					<nav class="navegacion">
						<a href="/curso_desarrollo_web_completo/bienes_raices/nosotros.php">Nosotros</a>
						<a href="/curso_desarrollo_web_completo/bienes_raices/anuncios.php">Anuncios</a>
						<a href="/curso_desarrollo_web_completo/bienes_raices/blog.php">Blog</a>
						<a href="/curso_desarrollo_web_completo/bienes_raices/contacto.php">Contacto</a>
						<?php if ($auth) : ?>
							<a href="/curso_desarrollo_web_completo/bienes_raices/cerrar-sesion.php">Cerrar Sesión</a>
						<?php endif; ?>
					</nav>
				</div>
			</div>

			<?php
			if ($inicio)
				echo "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>"
			?>
		</div>
	</header>
