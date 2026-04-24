<?php

use App\controllers\SessionController;

function e(?string $texto): string
{
    return htmlspecialchars($texto ?? '', ENT_QUOTES, 'UTF-8');
}

function flash(?string $tipo = null, ?string $mensaje = null): ?array
{
    if ($tipo !== null && $mensaje !== null) {
        SessionController::flash($tipo, $mensaje);
        return null;
    }

    return SessionController::getFlash();
}
