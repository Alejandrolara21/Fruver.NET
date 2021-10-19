<?php

namespace Controllers;

use MVC\Router;
use Model\Administrador;
use Model\Cliente;
use Model\Proveedor;

class LoginRegistroController{
    public static function login(Router $router){
        $login = true;
        $errores = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $administrador = new Administrador($_POST);
            $cliente = new Cliente($_POST);
            $proveedor = new Proveedor($_POST);
            $errores = $administrador -> validar();


            if(empty($errores)){
                if($administrador -> existeUsuario()){
                    $resultado = $administrador -> existeUsuario();
                    $autenticado = $administrador -> validarContraseña($resultado);

                    if($autenticado){
                        $administrador -> autenticar();
                    }else{
                        $errores = $administrador::getErrores();
                    }

                }elseif($cliente -> existeUsuario()){
                    $resultado = $cliente -> existeUsuario();
                    $autenticado = $cliente -> validarContraseña($resultado);

                    if($autenticado){
                        $cliente -> autenticar();
                    }else{
                        $errores = $cliente::getErrores();
                    }

                }elseif($proveedor -> existeUsuario()){
                    $resultado = $proveedor -> existeUsuario();
                    $autenticado = $proveedor -> validarContraseña($resultado);

                    if($autenticado){
                        $proveedor -> autenticar();
                    }else{
                        $errores = $proveedor::getErrores();
                    }
                }else{
                    $errores = $administrador::getErrores();
                }
            }
        }

        $router -> mostrarVistaPaginaLibres('login',[
            'login' => $login,
            'errores' => $errores
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function registrar(Router $router){
        $router -> mostrarVistaPaginaLibres('registrar',[]);
    }
}