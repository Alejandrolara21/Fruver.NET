<?php

namespace Controllers;

use MVC\Router;

class ClienteController{
    public static function index(Router $router){
        if($_SESSION['rol'] == 'cliente'){
            $router -> mostrarVistaCliente('cliente/index',[]);
        }else{
            header("Location: /".$_SESSION['rol']);
        } 
    }
}