<?php



require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/lib/utils.php';

use App\controllers\AlumnoController;
use App\controllers\SessionController;

//Inciar la sesión si no existe
SessionController::start();

$controller = new AlumnoController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'crear':
        $controller->crear();
        break;
    case 'guardar':
        $controller->guardar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    default:
        $controller->index();
        break;
}
