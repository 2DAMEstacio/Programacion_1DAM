<?php

namespace App\controllers;

class EncuestaController
{
    public function index(): void
    {
        // Comprueba primero que el usuario esté autenticado antes de permitir el acceso a esta pantalla.
        // Recupera la pregunta que deba mostrarse en ese momento, es decir, la que esté marcada como disponible para votar.
        // Si no existe ninguna pregunta activa, prepara variables vacías o por defecto para que la interfaz pueda mostrarse sin errores.
        // Si sí existe, obtén también las posibles respuestas asociadas y averigua si el usuario actual ya ha participado.
        // Una vez preparados los datos, carga la interfaz completa de la página principal de la encuesta.
        echo "Hola " . SessionController::usuarioNombre();
    }

    public function votar(): void
    {
        // Comprueba que el usuario haya iniciado sesión antes de aceptar el envío del voto.
        // Recupera del formulario los identificadores necesarios para saber qué pregunta se está respondiendo y qué opción se ha elegido.
        // Valida que esos identificadores existan y tengan un formato numérico válido antes de continuar.
        // Si los datos no son correctos, guarda un mensaje flash de error para mostrarlo una sola vez en la siguiente petición y redirige de vuelta a la pantalla de votación.
        // Antes de guardar nada, verifica si el usuario ya había votado en esa misma pregunta para impedir duplicados.
        // Recupera la opción elegida y comprueba que realmente pertenece a la pregunta recibida, evitando manipulaciones del formulario.
        // Crea la entidad que representa el voto con el usuario autenticado, la pregunta y la opción seleccionada.
        // Abre una transacción para que el alta del voto y la actualización del contador se realicen como una única operación atómica.
        // Dentro de esa transacción, guarda el voto y actualiza el número de votos acumulados de la opción elegida.
        // Si algo falla en cualquiera de los pasos, revierte los cambios, informa al usuario y vuelve a la pantalla de la encuesta.
        // Si todo va bien, confirma los cambios, muestra un mensaje de éxito y redirige a la pantalla de resultados.
    }

    public function resultados(): void
    {
        // Comprueba que el usuario esté autenticado antes de permitir el acceso a los resultados.
        // Recupera la pregunta que está activa para poder mostrar sus resultados asociados.
        // Si no existe ninguna pregunta disponible, prepara valores por defecto para que la interfaz siga siendo válida.
        // Si existe una pregunta activa, obtén todas sus opciones y calcula cuántos votos se han emitido en total.
        // Finalmente, carga la interfaz completa encargada de mostrar la pregunta, sus opciones y las estadísticas correspondientes.
    }
}
