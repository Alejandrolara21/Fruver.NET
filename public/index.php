<?php
require_once __DIR__.'/../includes/app.php';

use MVC\Router;
use Controllers\PaginasLiController;
use Controllers\LoginRegistroController;
use Controllers\AdministradorController;
use Controllers\ClienteController;
use Controllers\ProveedorController;

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

// Paginas Proveedor
$router -> getUrl('/proveedor',[ProveedorController::class,'index']);

// Paginas Cliente
$router -> getUrl('/cliente',[ClienteController::class,'index']);

$router -> comprobarRutas();