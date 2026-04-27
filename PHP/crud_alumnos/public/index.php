<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/lib/utils.php';

use App\controllers\AlumnoController;
use App\controllers\AuthController;
use App\controllers\DashboardController;
use App\controllers\SessionController;

// Iniciar la sesión si no existe.
SessionController::start();

$alumnoController = new AlumnoController();
$dashboardController = new DashboardController();
$authController = new AuthController();

$accion = $_GET['accion'] ?? 'index';
$usuario = SessionController::get('usuario');
$accionesPublicas = ['login', 'autenticar', 'registrar'];

if ($usuario === null && !in_array($accion, $accionesPublicas)) {
    $accion = 'login';
}

switch ($accion) {
    case 'crear':
        $alumnoController->crear();
        break;
    case 'guardar':
        $alumnoController->guardar();
        break;
    case 'editar':
        $alumnoController->editar();
        break;
    case 'actualizar':
        $alumnoController->actualizar();
        break;
    case 'eliminar':
        $alumnoController->eliminar();
        break;
    case 'resumen':
        $dashboardController->resumen();
        break;
    case 'autenticar':
        $authController->authenticate();
        break;
    case 'registrar':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'login':
        $authController->loginPage();
        break;
    default:
        $alumnoController->index();
        break;
}
