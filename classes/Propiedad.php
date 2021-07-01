<?php

namespace App;

class Propiedad
{
    // Base d datos
    protected static $db;
    protected static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedorId"];

    // Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedorId = $args["vendedorId"] ?? "1";
    }

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

        $query = "INSERT INTO propiedades(";
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

        $query = "UPDATE propiedades set ";
        $query .= $campos;
        $query .= " WHERE id='" . self::$db->escape_string($this->id) . "' LIMIT 1";


        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function eliminar()
    {
        // Elimino la propiedad
        $query = "DELETE FROM propiedades WHERE id=" . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function atributos()
    {
        $atributos = [];

        foreach (self::$columnasDB as $columna) {
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
        return self::$errores;
    }

    /**
     * Valida que los atributos no estén vacios.
     *
     * @return array
     */
    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "El título es requerido";
        }

        if (!$this->precio) {
            self::$errores[] = "El precio es requerido";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripcion es requerida y debe contener al menos 50 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Número de habitaciones requerido";
        }

        if (!$this->wc) {
            self::$errores[] = "Número de baños requerido";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "Número de estacionamientos requerido";
        }

        if (!$this->vendedorId) {
            self::$errores[] = "Vendedor es requerido";
        }

        if (!$this->imagen) {
            self::$errores[] = "Selecciona una imagen";
        }

        return self::$errores;
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
        $query = "SELECT * FROM propiedades";

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

    protected static function crearObjeto(array $registro): Propiedad
    {
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    public static function find($id)
    {
        $query = "SELECT * FROM propiedades where id='" . self::$db->escape_string($id) . "'";

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
