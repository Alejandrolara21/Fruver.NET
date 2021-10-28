<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Model\ImagenProducto;
use Model\TipoProducto;
use Intervention\Image\ImageManagerStatic as Image;

session_start();

class AdministradorController
{
    public static function index(Router $router)
    {
        if ($_SESSION['rol'] == 'administrador') {
            $router->mostrarVistaAdministrador('administrador/index', []);
        } else {
            header("Location: /" . $_SESSION['rol']);
        }
    }

    public static function productos(Router $router)
    {
        $productos = Producto::all();
        $imagenes = ImagenProducto::all();
        //Mostrar mensaje condicional
        $mensaje = $_GET['mensaje'] ?? null;

        $router->mostrarVistaAdministrador('administrador/producto/listaProductos', [
            'productos' => $productos,
            'imagenes' => $imagenes,
            'mensaje' => $mensaje
        ]);
    }

    public static function productosCrear(Router $router)
    {
        $producto = new Producto;
        $bandReferencia = true;
        $tipo = TipoProducto::all();
        $errores = Producto::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $producto = new Producto($_POST['producto']);
            $errores = $producto->validar();
            if (empty($errores)) {

                $resultadoProducto = $producto->insertarRegistro();

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                $referencia = $producto->getReferencia();
                if (isset($_FILES['imagen']) and $_FILES["imagen"]["tmp_name"] != "") {
                    $cantidad = count($_FILES["imagen"]["tmp_name"]);
                    for ($i = 0; $i < $cantidad; $i++) {
                        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                        $image = Image::make($_FILES['imagen']['tmp_name'][$i])->fit(800, 600);
                        $imagenProducto = new ImagenProducto();
                        $imagenProducto->setNombre($nombreImagen);
                        $imagenProducto->setReferencia($referencia);
                        //GUARDAR IMAGEN EN EL SERVIDOR
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                        $resultadoImagen = $imagenProducto->insertarRegistro();
                    }

                    if ($resultadoProducto && $resultadoImagen) {
                        header('Location: /administrador/productos?mensaje=1');
                    }
                } else {
                    if ($resultadoProducto) {
                        header('Location: /administrador/productos?mensaje=1');
                    }
                }
            }
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
        }
        $router->mostrarVistaAdministrador('administrador/producto/crearProducto', [
            'tipo' => $tipo,
            'bandReferencia' => $bandReferencia,
            'errores' => $errores
        ]);
    }

    public static function productosActualizar(Router $router)
    {
        $referencia = validarORedireccionar('/administrador/productos');
        $bandReferencia = false;
        $auxProducto = Producto::find($referencia, 'referencia');
        $producto = $auxProducto[0];
        $imagenes = ImagenProducto::find($referencia, 'referencia');
        $tipo = TipoProducto::all();
        $errores = Producto::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['imagen'])) {
                $imagenesParaBorrar = $_POST['imagen'];
            }
            $atributos = $_POST['producto'];
            $producto->actualizarAtributos($atributos);
            $errores = $producto->validar();

            if (empty($errores)) {
                $resultadoProducto = $producto->actualizarRegistro('referencia');
                if ($imagenesParaBorrar) {
                    foreach ($imagenes as $imagen) {
                        for ($i = 0; $i < count($imagenesParaBorrar); $i++) {
                            if ($imagen->nombre == $imagenesParaBorrar[$i]) {
                                $imagen->eliminarRegistroImagen();
                                $imagen->eliminarImagen('nombre');
                            }
                        }
                    }
                }
                if (isset($_FILES['imagen']) && $_FILES["imagen"]["tmp_name"][0] != "") {

                    $cantidad = count($_FILES["imagen"]["tmp_name"]);
                    for ($i = 0; $i < $cantidad; $i++) {
                        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                        $image = Image::make($_FILES['imagen']['tmp_name'][$i])->fit(800, 600);
                        $imagenProducto = new ImagenProducto();
                        $imagenProducto->setNombre($nombreImagen);
                        $imagenProducto->setReferencia($referencia);
                        //GUARDAR IMAGEN EN EL SERVIDOR
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                        $resultadoImagen = $imagenProducto->insertarRegistro();
                    }

                    if ($resultadoProducto || $resultadoImagen) {
                        header('Location: /administrador/productos?mensaje=2');
                    }
                } else {
                    if ($resultadoProducto) {
                        header('Location: /administrador/productos?mensaje=2');
                    }
                }
            }
        }
        $router->mostrarVistaAdministrador('administrador/producto/actualizarProducto', [
            'producto' => $producto,
            'imagenes' => $imagenes,
            'tipo' => $tipo,
            'bandReferencia' => $bandReferencia,
            'errores' => $errores
        ]);
    }
}
