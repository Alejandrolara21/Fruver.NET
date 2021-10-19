<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost','root','7312010','fruteria_practica');

    if(!$db){
        echo "ERROR, No se pudo conectar a la Base de datos";
        exit;
    }

    return $db;
}