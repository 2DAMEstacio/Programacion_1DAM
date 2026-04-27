<?php

namespace App\controllers;

use App\models\Usuario;

class AuthController
{
    public function mostrarLogin(): void
    {
        // Muestra la interfaz de autenticación del usuario.
        // Recuerda incluir la parte común superior, el contenido principal del formulario y la parte común inferior.
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/auth/login.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function login(): void
    {

        // $_POST['email']
        // $_POST['password']
        // Recoge los datos enviados por el formulario y asegúrate de limpiarlos mínimamente antes de usarlos.
        // Comprueba que se han recibido los campos imprescindibles para autenticar al usuario.

        // Utilizando el modelo de usuarios, solicita la operación que verifica si las credenciales coinciden con un usuario registrado.
        $usuarioValidado = Usuario::validarLogin($_POST['email'],  $_POST['password']);
        if ($usuarioValidado == null) {
            // Si las credenciales no son válidas, guarda un mensaje flash de error para mostrarlo una sola vez en la siguiente petición y vuelve a la pantalla de acceso.
            SessionController::flash('error', 'email o password incorrectos');
        } else {
            // Si la autenticación es correcta, guarda en sesión la información básica necesaria para identificar al usuario.
            SessionController::flash('success', 'Login correcto');
            SessionController::login($usuarioValidado->getId(), $usuarioValidado->getNombre());
        }

        // Termina redirigiendo a la zona principal de la aplicación con un mensaje de confirmación.
        header("Location:index.php");
        exit;
    }

    public function mostrarRegistro(): void
    {
        // Muestra la interfaz de alta de nuevos usuarios.
        // Recuerda incluir la parte común superior, el contenido principal del formulario y la parte común inferior.
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/auth/registro.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    public function registro(): void
    {
        // Recoge la información enviada por el formulario de alta y prepara un objeto con esos datos.

        // $_POST['nombre']
        // $_POST['email']
        // $_POST['password']
        // Valida aspectos básicos como campos obligatorios, formato del correo y posibles duplicados.
        $erroresValidacion = Usuario::validate($_POST);
        if (count($erroresValidacion) > 0) {
            // Si alguna validación falla, guarda un mensaje flash con el error para mostrarlo una sola vez en la siguiente petición y vuelve al formulario.
            SessionController::flash('error', 'Existen errores al realizar el registro');
            $this->mostrarRegistro();
        } else {
            // Si la información es correcta, utiliza el modelo de usuarios para guardar el nuevo registro.
            $nuevoUsuario = Usuario::usuarioFromPost($_POST);
            $respuestaInsert =  $nuevoUsuario->insert();
            if ($respuestaInsert == false) {
                // Si ocurre algún problema al persistirlo, informa al usuario y vuelve a la pantalla de alta.
                SessionController::flash('error', 'Error al crear el usuario');
                $this->mostrarRegistro();
            } else {
                // Si el proceso finaliza correctamente, muestra un mensaje de éxito y redirige a la pantalla de acceso.
                SessionController::flash('success', 'Usuario creado correctamente');
                SessionController::login($nuevoUsuario->getId(), $nuevoUsuario->getNombre());
                header("Location:index.php");
                exit;
            }
        }
    }

    public function logout(): void
    {
        // Elimina la información de autenticación almacenada en sesión para cerrar la sesión activa.
        SessionController::logout();
        // Después redirige al usuario a la pantalla de acceso.
        header("Location:index.php/?action=login");
        exit;
    }
}
