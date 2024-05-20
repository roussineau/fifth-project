<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    // Base de datos:
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamientos', 'creado', 'vendedorId'];


    // Atributos:
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedorId;


    // Constructor: toma como parametro $_POST
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }


    // Validacion:
    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "El título es obligatorio";
        }
        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }
        if (strlen($this->descripcion) < 50 && $this->descripcion) {
            self::$errores[] = "La descripción debe tener al menos 50 caracteres";
        } elseif (!$this->descripcion) {
            self::$errores[] = "La descripción es obligatoria";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "La cantidad de habitaciones es obligatoria";
        }
        if (!$this->wc) {
            self::$errores[] = "La cantidad de baños es obligatoria";
        }
        if (!$this->estacionamientos) {
            self::$errores[] = "La cantidad de estacionamientos es obligatoria";
        }
        if (!$this->vendedorId) {
            self::$errores[] = "Seleccione un vendedor";
        }
        return static::$errores;
    }
}
