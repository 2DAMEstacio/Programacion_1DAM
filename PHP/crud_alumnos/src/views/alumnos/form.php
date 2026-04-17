<?php

declare(strict_types=1);

$title = $titulo;
require __DIR__ . '/../partials/header.php';
?>
<section class="hero compact">
    <div>
        <span class="eyebrow">Formulario</span>
        <h1><?= e($titulo) ?></h1>
    </div>
    <a class="button button-secondary" href="index.php">Volver al listado</a>
</section>

<?php if ($errores !== []): ?>
    <div class="notice error">
        <strong>Revisa el formulario.</strong>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<section class="panel form-panel">
    <form method="post" action="index.php?accion=<?= $modo === 'crear' ? 'guardar' : 'actualizar' ?>" class="form-grid">
        <?php if ($modo === 'editar'): ?>
            <input type="hidden" name="id" value="<?= e($alumno->getId()) ?>">
        <?php endif; ?>

        <label>
            <span>Nombre</span>
            <input type="text" name="nombre" value="<?= e($alumno->getNombre()) ?>" placeholder="Nombre y apellidos" required>
        </label>

        <label>
            <span>Email</span>
            <input type="email" name="email" value="<?= e($alumno->getEmail()) ?>" placeholder="usuario@ies.local" required>
        </label>

        <label>
            <span>Edad</span>
            <input type="number" name="edad" min="16" max="99" value="<?= e($alumno->getEdad()) ?>" required>
        </label>

        <label>
            <span>Curso</span>
            <input type="text" name="curso" value="<?= e($alumno->getCurso()) ?>" placeholder="1DAM" required>
        </label>
        <label>
            <span>Es friki</span>
            <select name="esfriki">
                <option value="1" <?= e($alumno->getEsfriki() ? "selected" : "") ?>>Sí</option>
                <option value="0" <?= e($alumno->getEsfriki() ? "" : "selected") ?>>No</option>
            </select>
        </label>
        <label>
            <span>Nota media</span>
            <input type="number" name="nota" value="<?= e($alumno->getNota()) ?>" required>
        </label>
        <label>
            <span>Url avatar</span>
            <input type="text" name="avatar" value="<?= e($alumno->getAvatar()) ?>" required>
        </label>

        <div class="form-actions">
            <button class="button button-primary" type="submit"><?= $modo === 'crear' ? 'Guardar alumno' : 'Actualizar alumno' ?></button>
            <a class="button button-secondary" href="index.php">Cancelar</a>
        </div>
    </form>
</section>
<?php require __DIR__ . '/../partials/footer.php'; ?>