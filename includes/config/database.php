<?php


function conectarDB(): mysqli
{
    $db = new mysqli("127.0.0.1", "root", "root", "bienes_raices");

    if (!$db) {
        echo "Error al conectarse a la base de datos";
        exit;
    }

    return $db;
}
