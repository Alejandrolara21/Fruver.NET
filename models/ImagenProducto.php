<?php

namespace Model;

class ImagenProducto extends MainModel{

    // Base de datos
    protected static $tabla = 'imagen_producto';
    protected static $columnaDB = ['referencia','nombre'];

    public $referencia;
    public $nombre;


    public function __construct($args = [])
    {
        $this->referencia = $args['referencia'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
    }

    public function getReferencia(){
        return $this -> referencia;
    }
    
    public function setReferencia($referencia){
        $this -> referencia = $referencia;
    }

    public function getNombre(){
        return $this -> nombre;
    }
    
    public function setNombre($nombre){
        $this -> nombre = $nombre;
    }

    public function validar(){
    }


    public function eliminarRegistroImagen()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE referencia = " . self::$db->escape_string($this->referencia) . " and nombre = '" . self::$db->escape_string($this->nombre) . "' LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

}