<?php

namespace App;

class ActiveRecord
{
    protected static $tabla = "";

    // Base d datos
    protected static $db;
    protected static $columnasDB = [];

    // Errores
    protected static $errores = [];

    public function guardar()
    {
        if (!is_null($this->id)) {
            // Actualizar
            return $this->actualizar();
        } else {
            // Crear
            return $this->crear();
        }
    }

    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $atributosInsert = join(", ", array_keys($atributos));
        $valuesInsert = join("', '", array_values($atributos));

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= $atributosInsert;
        $query .= ") VALUES ('";
        $query .= $valuesInsert;
        $query .= "')";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key='$value'";
        }

        $campos = join(", ", $valores);

        $query = "UPDATE " . static::$tabla . " set ";
        $query .= $campos;
        $query .= " WHERE id='" . self::$db->escape_string($this->id) . "' LIMIT 1";


        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function eliminar()
    {
        // Elimino registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id=" . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnasDB as $columna) {
            if ($columna === "id") continue;

            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarAtributos(): array
    {
        $atributos = $this->atributos();
        $sanitizados = [];

        foreach ($atributos as $key => $value) {
            $sanitizados[$key] = self::$db->escape_string($value);
        }

        return $sanitizados;
    }

    public static function getErrores()
    {
        return static::$errores;
    }

    /**
     * Valida que los atributos no estén vacios.
     *
     * @return array
     */
    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    public function setImagen($imagen)
    {
        // Si la propiedad tiene id, entonces se está actualizando una propiedad
        // por lo tanto, debemos remover la imagen previa.
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        $existeImagen = file_exists(IMAGENES_URL . $this->imagen);

        if ($existeImagen) {
            unlink(IMAGENES_URL . $this->imagen);
        }
    }

    public static function all(): array
    {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    /**
     * Obtiene cierta cantidad de registros
     *
     * @param int $cantidad
     */
    public static function get($cantidad): array
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    protected static function consultarSQL(string $query): array
    {
        $resultado = self::$db->query($query);

        $arrayObjetos = [];
        while ($registro = $resultado->fetch_assoc()) {
            $arrayObjetos[] = self::crearObjeto($registro);
        }

        $resultado->free();

        return $arrayObjetos;
    }

    protected static function crearObjeto(array $registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " where id='" . self::$db->escape_string($id) . "'";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }
}
