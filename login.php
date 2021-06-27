<?php
require "includes/config/database.php";
$db = conectarDB();

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST["password"]);


    if (!$email) {
        $errores[] = "Ingrese un email válido";
    }

    if (strlen($password) === 0) {
        $errores[] = "Ingrese una contraseña";
    }

    if (empty($errores)) {
        // Revisar si correo existe.
        $queryExisteUsuario = "SELECT * FROM usuarios WHERE email='$email'";
        $resultadoExisteUsuario = mysqli_query($db, $queryExisteUsuario);

        if ($resultadoExisteUsuario->num_rows > 0) {
            // Verifico si contraseña es correcta
            $usuario = mysqli_fetch_assoc($resultadoExisteUsuario);
            $auth = password_verify($password, $usuario["password"]);

            if ($auth) {
                // EL usuario está autenticado
                session_start();

                $_SESSION["usuario"] = $usuario["email"];
                $_SESSION["login"] = true;

                header("Location: admin/");
            } else {
                $errores[] = "El password es incorrecto";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}


require "includes/funciones.php";
incluirTemplate("header", false);
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Tu Email" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Tu Password" required />
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

    </form>
</main>

<?php
incluirTemplate("footer");
?>
