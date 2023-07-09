<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\LoginController;
use Controllers\MenuController;
use MVC\Router;
$router = new Router();


//Iniciar sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);
$router->get('/retrieve', [LoginController::class, 'retrieve']);
$router->post('/retrieve', [LoginController::class, 'retrieve']);

//Crear cuenta
$router->get('/create-account', [LoginController::class, 'create']);
$router->post('/create-account', [LoginController::class, 'create']);

//confirmar cuenta:
$router->get('/confirm-account', [LoginController::class, 'confirm']);
$router->get('/message', [LoginController::class, 'message']);

//Area privada
$router->get('/main-menu', [MenuController::class, 'index']);
$router->get('/admin-panel', [AdminController::class, 'index']);

//API de platillos
$router->get('/api/platillos', [ApiController::class, 'index']);
$router->post('/api/pedidos', [ApiController::class, 'guardar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();

