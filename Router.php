<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function getUrl($url, $funt)
    {
        $this->rutasGET[$url] = $funt;
    }

    public function postUrl($url, $funt)
    {
        $this->rutasPOST[$url] = $funt;
    }

    public function comprobarRutas()
    {
        session_start();

        $auth = $_SESSION['login'] ?? false;
        // ARRAY para rutas protegidas  
        $rutas_protegidas = ['/administrador','/proveedor','/cliente'];


        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $funcion = $this->rutasGET[$urlActual] ?? null;
        }else{
            $funcion = $this->rutasPOST[$urlActual] ?? null;
        }

        if(in_array($urlActual,$rutas_protegidas) && !$auth){
            header('Location: /');
        }

        if ($funcion) {
            //La URL exite y tiene una funcion asociada
            call_user_func($funcion, $this);
        } else {
            echo "Página no encontrada -- ERROR 404";
        }
    }

    public function mostrarVistaPaginaLibres($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start();
        include __DIR__."/views/${view}.php";
        $contenido = ob_get_clean();
        include __DIR__."/views/paginas_libres/layout.php";
    }

    public function mostrarVistaAdministrador($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start();
        include __DIR__."/views/${view}.php";
        $contenido = ob_get_clean();
        include __DIR__."/views/administrador/layout.php";
    }

    public function mostrarVistaProveedor($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start();
        include __DIR__."/views/${view}.php";
        $contenido = ob_get_clean();
        include __DIR__."/views/proveedor/layout.php";
    }

    public function mostrarVistaCliente($view, $datos = []){
        foreach($datos as $key => $value){
            $$key = $value;
        }

        ob_start();
        include __DIR__."/views/${view}.php";
        $contenido = ob_get_clean();
        include __DIR__."/views/cliente/layout.php";
    }
}
