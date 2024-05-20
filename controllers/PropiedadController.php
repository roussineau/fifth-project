<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController
{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        // Arreglo con vendedores:
        $vendedores = Vendedor::all();
        // Arreglo con mensajes de error: 
        $errores = Propiedad::getErrores();

        // A ejecutar despues de que el usuario envie el formulario:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear nueva instancia:
            $propiedad = new Propiedad($_POST['propiedad']);
            // ** Subida de archivos: **
            // Renombrar imagen:
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                // Realiza un resize a la imagen con Intervention:
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                // Setear imagen:
                $propiedad->setImagen($nombreImagen);
            }

            // Validar:
            $errores = $propiedad->validar();

            // Revisar que el arreglo de errores esté vacio:
            if (empty($errores)) {

                // Crear la carpeta para subir imagenes:
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guardar la imagen en la base de datos:
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guardar propiedad en la base de datos:
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionarHacia('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        // A ejecutar despues de que el usuario envie el formulario:
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignamos los atributos actualizados:
            $args = $_POST['propiedad'];
            $propiedad->sincronizar($args);
            // Validacion:
            $errores = $propiedad->validar();

            // Revisar que el arreglo de errores esté vacio:
            if (empty($errores)) {

                // La imagen solo se actualizara si no hay errores
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    // Renombrar imagen:
                    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                    // Realiza un resize a la imagen con Intervention:
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                    // Setear imagen:
                    $propiedad->setImagen($nombreImagen);
                    // Guardar imagen en DB:
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                } else {
                    header('Location: /admin');
                }
            }
        }
    }
}
