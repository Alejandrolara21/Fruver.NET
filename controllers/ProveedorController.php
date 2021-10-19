<?php

namespace Controllers;

use MVC\Router;

class ProveedorController{
    public static function index(Router $router){
        if($_SESSION['rol'] == 'proveedor'){
            $router -> mostrarVistaProveedor('proveedor/index',[]);
        }else{
            header("Location: /".$_SESSION['rol']);
        } 
    }
}