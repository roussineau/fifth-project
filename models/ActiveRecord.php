<?php


namespace Model;

class ActiveRecord
{
    // Base de datos:
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';


    // Errores:
    protected static $errores = [];


    // Setear la conexion a base de datos:
    public static function setDB($database)
    {
        self::$db = $database;
    }


    // Manejo de registros en la base de datos:
    public function guardar()
    {
        if (!is_null($this->id)) {
            // Actualizar un registro:
            $this->actualizar();
        } else {
            // Crear un nuevo registro:
            $this->crear();
        }
    }

    public function crear()
    {
        $atributos = $this->sanitizarAtributos();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = static::$db->query($query);

        if ($resultado) {
            // Redireccionamos al usuario:
            header('Location: /admin?resultado=1');
        }

        return $resultado;
    }

    public function actualizar()
    {
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key='$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = static::$db->query($query);

        if ($resultado) {
            // Redireccionamos al usuario:
            header('Location: /admin?resultado=2');
        }
    }

    // Eliminar un registro:
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }


    // Identificar y unir (mapear) los atributos de la base de datos:
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }


    // Sanitizar los datos:
    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizados = [];
        foreach ($atributos as $key => $value) { // para mantener la estructura clave-valor
            $sanitizados[$key] = self::$db->escape_string($value);
        }
        return $sanitizados;
    }
    

    // Manejo de archivos:
    public function setImagen($nombreImagen)
    {
        // Elimina la imagen previa:
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        if ($nombreImagen) {
            $this->imagen = $nombreImagen;
        }
    }

    public function borrarImagen()
    {
        // Comprobar si existe el archivo:
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }


    // Validacion:
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }


    // Listar todas los registros:
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


    // Listar un determinado numero de registros:
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $limite;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


    // Buscar un registro por su ID:
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }


    public static function consultarSQL($query)
    {
        // Consultar la base de datos:
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $arreglo = [];
        while ($registro = $resultado->fetch_assoc()) {
            $arreglo[] = static::crearObjeto($registro);
        }

        // Liberar memoria
        $resultado->free();

        // Retornar los resultados
        return $arreglo;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizados por el usuario:
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
