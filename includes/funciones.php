<?php
require "app.php";

function incluirTemplate(string $nombre, bool $inicio = false, string $rutaBuild = "")
{
    include TEMPLATES_URL . "/${nombre}.php";
}
