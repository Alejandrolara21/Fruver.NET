<?php

namespace Controllers;

use MVC\Router;

class PaginasLiController{

    public static function index(Router $router){
        $login = "";
        $router -> mostrarVistaPaginaLibres('paginas_libres/index',[
            'login' => $login
        ]);
    }
    
}