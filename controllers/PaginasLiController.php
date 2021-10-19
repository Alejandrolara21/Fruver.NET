<?php

namespace Controllers;

use MVC\Router;

class PaginasLiController{

    public static function index(Router $router){
        $router -> mostrarVistaPaginaLibres('paginas_libres/index',[]);
    }
    
}