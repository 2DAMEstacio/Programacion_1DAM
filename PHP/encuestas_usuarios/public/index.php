<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/utils.php';

use App\controllers\AuthController;
use App\controllers\EncuestaController;
use App\controllers\SessionController;

//Inicia la sesión en nuestro sistema
SessionController::start();

$action = $_GET['action'] ?? 'encuesta';

$authController = new AuthController();
$encuestaController = new EncuestaController();

switch ($action) {
    case 'login':
        $authController->mostrarLogin();
        break;
    case 'doLogin':
        $authController->login();
        break;
    case 'registro':
        $authController->mostrarRegistro();
        break;
    case 'doRegistro':
        $authController->registro();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'votar':
        $encuestaController->votar();
        break;
    case 'resultados':
        $encuestaController->resultados();
        break;
    case 'encuesta':
    default:
        $encuestaController->index();
        break;
}
