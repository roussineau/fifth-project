<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear una nueva instancia:
            $vendedor = new Vendedor($_POST['vendedor']);
        
            // Validar que no haya errores:
            $errores = $vendedor->validar();
        
            // Revisar que el arreglo de errores esté vacio:
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionarHacia('/admin');
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignamos los atributos actualizados:
            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);
        
            // Validar que no haya errores:
            $errores = $vendedor->validar();
        
            // Revisar que el arreglo de errores esté vacio:
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar ID:
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } else {
                    header('Location: /admin');
                }
            }
        }
    }
}
