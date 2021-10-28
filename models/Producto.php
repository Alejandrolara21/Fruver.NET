<?php

namespace Model;

class Producto extends MainModel{

    // Base de datos
    protected static $tabla = 'producto';
    protected static $columnaDB = ['referencia','nombre','fecha','precio','descripcion','cantidad','id_estado_prod','id_tipo_prod'];

    public $referencia;
    public $nombre;
    public $fecha;
    public $precio;
    public $descripcion;
    public $cantidad;
    public $id_estado_prod;
    public $id_tipo_prod;

    public function __construct($args = [])
    {
        $this->referencia = $args['referencia'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->fecha = date('Y-m-d');
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->id_estado_prod = $args['id_estado_prod'] ?? 1;
        $this->id_tipo_prod = $args['id_tipo_prod'] ?? '';
    }

    public function getEstado(){
        return $this -> id_estado_prod;
    }
    
    public function setEstado($estado){
        $this -> id_estado_prod = $estado;
    }

    public function getReferencia(){
        return $this -> referencia;
    }


    public function validar(){
        if (!$this->referencia || !$this->nombre || !$this->fecha || !$this->precio || !$this->descripcion || !$this->cantidad || !$this->id_estado_prod || !$this->id_tipo_prod){
            self::$errores[] = "Todos los campos son obligatorios!!!";
        }

        return self::$errores;
    }
}