<?php


require 'funciones.php';
require 'config/database.php';
require __DIR__.'/../vendor/autoload.php';


// Conexion con Base de datos
$db = conectarDB();

use Model\MainModel;

MainModel::setDB($db);
