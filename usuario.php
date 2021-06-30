<?php
require "includes/app.php";
$db = conectarDB();

$email = "correo@correo.com";
$password = "123456";
$passwordHasheado = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO usuarios(email, password) VALUES ('$email', '$passwordHasheado')";
$resultado = mysqli_query($db, $query);

if ($resultado) {
    echo "Usuario creado correctamente.";
}

mysqli_close($db);
