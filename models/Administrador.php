<?php

namespace Model;

class Administrador extends MainModel{

    // Base de datos
    protected static $tabla = 'administrador';
    protected static $columnaDB = ['id','nombre','apellido','correo','contraseña','imagen'];

    public $id;
    public $nombre;
    public $apellido;
    public $correo;
    public $contraseña;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->contraseña = $args['contraseña'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar(){
        if (!$this->correo) {
            self::$errores[] = "Debes añadir el correo";
        }

        if (!$this->contraseña) {
            self::$errores[] = "Debes añadir una contraseña";
        }

        return self::$errores;
    }

    public function existeUsuario(){
        $query = "SELECT * FROM ".self::$tabla." WHERE correo ='".$this->correo."' LIMIT 1";
        $resultado = self::$db->query($query);
        if(!$resultado -> num_rows){
            self::$errores[] = "El usuario no existe";

            return;
        }

        return $resultado;
    }

    public function validarContraseña($resultado){
        $usuario = $resultado -> fetch_object();
        $autenticado = password_verify($this -> contraseña, $usuario -> contraseña);

        if(!$autenticado){
            self::$errores[] = "La contraseña es incorrecta";
            return;
        }

        $this -> id = $usuario -> id;
        $this -> nombre = $usuario -> nombre;
        $this -> apellido = $usuario -> apellido;

        return $autenticado;
    }

    public function autenticar(){
        session_start();

        // Llenar el arreglo de session

        $_SESSION['datos'] = $this;
        $_SESSION['rol'] = "administrador";
        $_SESSION['login'] = true;

        header('Location: /administrador');
    }
}