<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    // Mapea las URL de tipo GET con una arreglo que contiene un controlador y una funcion a ejecutar:
    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    // Mapea las URL de tipo POST con una arreglo que contiene un controlador y una funcion a ejecutar:
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas:
        $rutas_protegidas = ['/admin', '/admin/propiedades/crear', '/admin/propiedades/actualizar', '/admin/propiedades/eliminar', '/admin/vendedores/crear', '/admin/vendedores/actualizar', '/admin/vendedores/eliminar'];

        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        // Buscar funcion a ejecutar segun la URL actual:
        if ($metodo === 'GET') {
            // En caso de que la URL sea valida, pasa un valor de $fn no nulo:
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else { // En PHP solo hay metodo GET y POST
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas:
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /login');
        }

        if ($fn) {
            // Llama una funcion que no sabemos su nombre:
            call_user_func($fn, $this);
        } else {
            echo 'Página no encontrada';
        }
    }

    // Muestra una vista:
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value; // Crea variables cuyos nombres son las llaves del arreglo de datos
        }
        ob_start(); // Inicia almacenamiento en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Guarda en una variable y limpia almacenamiento en memoria
        include __DIR__ . "/views/layout.php";
    }
}
