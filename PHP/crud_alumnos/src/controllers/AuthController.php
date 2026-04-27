<?php

declare(strict_types=1);

namespace App\controllers;

use App\models\Usuario;

final class AuthController
{
    public function loginPage(): void
    {
        $loginError = null;
        $registerErrors = [];
        $flash = SessionController::readAndRemove('flash');
        $loginEmail = '';
        $registerData = [
            'nombre' => '',
            'rol' => '',
            'email' => '',
        ];
        require __DIR__ . '/../views/pages/auth-example.php';
    }

    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=login');
            exit;
        }

        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $loginError = 'Debes introducir el email y la contraseña.';
            $registerErrors = [];
            $flash = SessionController::readAndRemove('flash');
            $loginEmail = $email;
            $registerData = [
                'nombre' => '',
                'rol' => '',
                'email' => '',
            ];
            require __DIR__ . '/../views/pages/auth-example.php';
            return;
        }

        $usuario = Usuario::findActiveByEmail($email);
        if ($usuario === null || !password_verify($password, $usuario->getPasswordHash())) {
            $loginError = 'Las credenciales introducidas no son válidas.';
            $registerErrors = [];
            $flash = SessionController::readAndRemove('flash');
            $loginEmail = $email;
            $registerData = [
                'nombre' => '',
                'rol' => '',
                'email' => '',
            ];
            require __DIR__ . '/../views/pages/auth-example.php';
            return;
        }

        Usuario::registerSuccessfulLogin((int) $usuario->getId());
        SessionController::set('usuario', $usuario);
        SessionController::set('flash', 'Bienvenido de nuevo, ' . $usuario->getNombre() . '.');
        header('Location: index.php');
        exit;
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?accion=login');
            exit;
        }

        $registerData = [
            'nombre' => trim((string) ($_POST['nombre'] ?? '')),
            'rol' => trim((string) ($_POST['rol'] ?? '')),
            'email' => trim((string) ($_POST['email'] ?? '')),
        ];

        $registerErrors = Usuario::validateRegistration($_POST);
        if ($registerErrors !== []) {
            $loginError = null;
            $flash = SessionController::readAndRemove('flash');
            $loginEmail = '';
            require __DIR__ . '/../views/pages/auth-example.php';
            return;
        }

        $usuario = Usuario::usuarioFromRegisterData($_POST);
        $usuario->insert();
        SessionController::set('usuario', $usuario);
        SessionController::set('flash', 'Cuenta creada correctamente. Bienvenido, ' . $usuario->getNombre() . '.');
        header('Location: index.php');
        exit;
    }

    public function logout(): void
    {
        SessionController::logout();
        SessionController::start();
        SessionController::set('flash', 'La sesión se ha cerrado correctamente.');
        header('Location: index.php?accion=login');
        exit;
    }
}
