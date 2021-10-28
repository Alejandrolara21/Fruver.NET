<?php
require_once __DIR__.'/../includes/app.php';

use MVC\Router;
use Controllers\PaginasLiController;
use Controllers\LoginRegistroController;
use Controllers\AdministradorController;
use Controllers\ClienteController;

$router = new Router();

//Paginas Libres
$router -> getUrl('/',[PaginasLiController::class,'index']);


// LOGIN
$router -> getUrl('/login',[LoginRegistroController::class,'login']);
$router -> postUrl('/login',[LoginRegistroController::class,'login']);
$router -> getUrl('/logout',[LoginRegistroController::class,'logout']);

$router -> getUrl('/registrar',[LoginRegistroController::class,'registrar']);
$router -> postUrl('/registrar',[LoginRegistroController::class,'registrar']);

// Paginas Administrador
$router -> getUrl('/administrador',[AdministradorController::class,'index']);
$router -> getUrl('/administrador/productos',[AdministradorController::class,'productos']);
$router -> getUrl('/administrador/productosCrear',[AdministradorController::class,'productosCrear']);
$router -> postUrl('/administrador/productosCrear',[AdministradorController::class,'productosCrear']);
$router -> getUrl('/administrador/productosActualizar',[AdministradorController::class,'productosActualizar']);
$router -> postUrl('/administrador/productosActualizar',[AdministradorController::class,'productosActualizar']);

// Paginas Cliente
$router -> getUrl('/cliente',[ClienteController::class,'index']);

$router -> comprobarRutas();