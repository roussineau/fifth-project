<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;

$router = new Router();

// Zona Admin
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/admin/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/admin/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/admin/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/admin/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/admin/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/admin/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/admin/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/admin/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/admin/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/admin/vendedores/eliminar', [VendedorController::class, 'eliminar']);

// Zona publica
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/anuncios', [PaginasController::class, 'anuncios']);
$router->get('/anuncio', [PaginasController::class, 'anuncio']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);

// Login y autenticacion
$router->get('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->post('/login', [LoginController::class, 'login']);


$router->comprobarRutas();