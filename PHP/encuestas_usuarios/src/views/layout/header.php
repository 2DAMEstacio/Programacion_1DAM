<?php
use App\controllers\SessionController;
$flash = flash();
$usuarioNombre = SessionController::usuarioNombre();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuestas con usuarios</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="site-header">
    <h1>Encuestas con usuarios</h1>
    <nav>
        <?php if ($usuarioNombre): ?>
            <span>Hola, <?= e($usuarioNombre) ?></span>
            <a href="index.php?action=encuesta">Encuesta</a>
            <a href="index.php?action=resultados">Resultados</a>
            <a href="index.php?action=logout">Salir</a>
        <?php else: ?>
            <a href="index.php?action=login">Login</a>
            <a href="index.php?action=registro">Registro</a>
        <?php endif; ?>
    </nav>
</header>

<main class="container">
    <?php if ($flash): ?>
        <div class="alert alert-<?= e($flash['tipo']) ?>">
            <?= e($flash['mensaje']) ?>
        </div>
    <?php endif; ?>
