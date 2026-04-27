<?php declare(strict_types=1); ?>
<?php

use App\controllers\SessionController;

$authUser = SessionController::user();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? ($_ENV['APP_NAME'] ?? $_SERVER['APP_NAME'] ?? 'CRUD Alumnos')) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/app.css">
    <link rel="stylesheet" href="/assets/vendor/toastr/toastr.min.css">
</head>
<body>
<div class="page-shell">
<?php if ($authUser !== null): ?>
    <section class="hero compact">
        <div>
            <span class="eyebrow">Sesion iniciada</span>
            <h1><?= e($authUser->getNombre()) ?></h1>
            <p><?= e($authUser->getEmail()) ?> · <?= e($authUser->getRol()) ?></p>
        </div>
        <a class="button button-secondary" href="index.php?accion=logout">Cerrar sesion</a>
    </section>
<?php endif; ?>
