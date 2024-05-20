<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    // Base de datos:
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];


    // Atributos:
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;


    // Constructor: toma como parametro $_POST
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }


    // Validacion:
    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }
        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatorio";
        } else {
            if (!preg_match('/[0-9]{10}/', $this->telefono)) { // Validamos que el telefono sea una expresion regular. En este caso, con caracteres del 0 al 9 y de 10 digitos.
                self::$errores[] = "El teléfono no es válido";
            }
        }
        return self::$errores;
    }
}
