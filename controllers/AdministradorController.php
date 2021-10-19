<?php

namespace Controllers;
use MVC\Router;

session_start();

class AdministradorController{
    public static function index(Router $router){
        if($_SESSION['rol'] == 'administrador'){
            $router -> mostrarVistaAdministrador('administrador/index',[]);
        }else{
            header("Location: /".$_SESSION['rol']);
        } 
    }
}