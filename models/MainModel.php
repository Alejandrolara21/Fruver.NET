<?php

namespace Model;

class MainModel
{
    protected static $db;
    protected static $columnaDB = [];
    protected static $tabla = '';

    //Validacion
    protected static $errores = [];


    // Definir conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function atributos()
    {
        $atributos = [];

        foreach (static::$columnaDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    public static function getErrores()
    {
        return static::$errores;
    }

    // SUBIR ARCHIVOS
    public function setImagen($imagen)
    {
        // Eliminar imagen previa para actualizar
        if (isset($this->id)) {
            $this->eliminarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function insertarRegistro()
    {
        // Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos();
        // INSERTAR EN LA BASE DE DATOS
        $query = "INSERT INTO " . static::$tabla . " ( " . join(',', array_keys($atributos)) . ") VALUES ('" . join("','", array_values($atributos)) . "')";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Actualizar registro
    public function actualizarAtributos($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    public function actualizarRegistro($columna='id')
    {
        // Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET " . join(', ', $valores) . " WHERE ${columna} = '" . self::$db->escape_string($this->$columna) . "' LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Consultar un registro por id
    public static function find($id,$columna = 'id')
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE ${columna}=${id}";
        $resultado[] = self::consultarSQL($query);
        return array_shift($resultado);
    }


    // Listar todos los registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtener determinado numero de registros
    public static function limiteRegistros($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla. " LIMIT ".$cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public function eliminarRegistro($columna ='id')
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE ${columna} = " . self::$db->escape_string($this->$columna) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function eliminarImagen($columna = 'imagen')
    {
        $existeImagen = file_exists(CARPETA_IMAGENES . $this->$columna);
        if ($existeImagen) {
            unlink(CARPETA_IMAGENES . $this->$columna);
        }
    }


    public static function consultarSQL($query)
    {
        //Consultar BD
        $resultado = self::$db->query($query);

        //Iterar resultado 
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        //Liberar memoria
        $resultado->free();
        //Retornar resultados
        return $array;
    }

    public static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
}
