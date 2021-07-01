<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define('IMAGENES_URL', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false, string $rutaBuild = "")
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado()
{
    session_start();

    if (!$_SESSION["login"]) {
        header("Location: /curso_desarrollo_web_completo/bienes_raices");
    }
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";

    exit;
}

function sanitizar($html)
{
    return htmlspecialchars($html);
}

function validarTipoContenido($tipo)
{
    $tipos = ["vendedor", "propiedad"];

    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo): string
{
    $mensaje = "";

    switch ($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Eliminado correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}
