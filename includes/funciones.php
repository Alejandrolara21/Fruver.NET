<?php

define('TEMPLATES_URL', __DIR__ . '/templates');

define('FUNCIONES_URL', __DIR__ . 'funciones.php');

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";;
}

function autenticacion()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}


function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//SANITIZAR HTML

function sanitizarHtml($html): string
{
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}


//Validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Anuncio de propiedad creado correctamente';
            break;
        case 2:
            $mensaje = 'Anuncio de propiedad actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Anuncio de propiedad eliminado correctamente';
            break;
        case 4:
            $mensaje = 'Vendedor creado correctamente';
            break;
        case 5:
            $mensaje = 'Vendedor actualizado correctamente';
            break;
        case 6:
            $mensaje = 'Vendedor eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}


function validarORedireccionar(string $url){
    //Validar que sera un Id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url}");
    }

    return $id;
}