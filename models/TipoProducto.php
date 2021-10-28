<?php

namespace Model;

class TipoProducto extends MainModel{

    // Base de datos
    protected static $tabla = 'tipo_producto';
    protected static $columnaDB = ['id','nombre'];

    public $id;
    public $nombre;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validar(){
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir";
        }
        return self::$errores;
    }
}