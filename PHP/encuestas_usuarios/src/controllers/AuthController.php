<?php

namespace App\controllers;

class AuthController
{
    public function mostrarLogin(): void
    {
        // Muestra la interfaz de autenticación del usuario.
        // Recuerda incluir la parte común superior, el contenido principal del formulario y la parte común inferior.
    }

    public function login(): void
    {
        // Recoge los datos enviados por el formulario y asegúrate de limpiarlos mínimamente antes de usarlos.
        // Comprueba que se han recibido los campos imprescindibles para autenticar al usuario.
        // Utilizando el modelo de usuarios, solicita la operación que verifica si las credenciales coinciden con un usuario registrado.
        // Si las credenciales no son válidas, guarda un mensaje flash de error para mostrarlo una sola vez en la siguiente petición y vuelve a la pantalla de acceso.
        // Si la autenticación es correcta, guarda en sesión la información básica necesaria para identificar al usuario.
        // Termina redirigiendo a la zona principal de la aplicación con un mensaje de confirmación.
    }

    public function mostrarRegistro(): void
    {
        // Muestra la interfaz de alta de nuevos usuarios.
        // Recuerda incluir la parte común superior, el contenido principal del formulario y la parte común inferior.
    }

    public function registro(): void
    {
        // Recoge la información enviada por el formulario de alta y prepara un objeto con esos datos.
        // Valida aspectos básicos como campos obligatorios, formato del correo y posibles duplicados.
        // Si alguna validación falla, guarda un mensaje flash con el error para mostrarlo una sola vez en la siguiente petición y vuelve al formulario.
        // Si la información es correcta, utiliza el modelo de usuarios para guardar el nuevo registro.
        // Si ocurre algún problema al persistirlo, informa al usuario y vuelve a la pantalla de alta.
        // Si el proceso finaliza correctamente, muestra un mensaje de éxito y redirige a la pantalla de acceso.
    }

    public function logout(): void
    {
        // Elimina la información de autenticación almacenada en sesión para cerrar la sesión activa.
        // Después redirige al usuario a la pantalla de acceso.
    }
}
