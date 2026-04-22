<?php

declare(strict_types=1);

$title = 'Panel de alumnos';
require __DIR__ . '/../partials/header.php';
?>
<section class="hero">
    <div>
        <span class="eyebrow">MYSQL + Composer</span>
        <h1>Gestión de alumnos</h1>
        <p>Proyecto MVC en PHP con una base ligera, configuración por entorno y una interfaz más cuidada para trabajar el CRUD sin fricción.</p>
    </div>
    <a class="button " href="index.php?accion=resumen">Dashboard</a>
    <a class="button button-primary" href="index.php?accion=crear">Nuevo alumno</a>
</section>

<?php if ($flash !== null): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.options = {
                closeButton: true,
                progressBar: true,
                newestOnTop: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: 3200,
                extendedTimeOut: 800,
                showDuration: 250,
                hideDuration: 200
            };

            toastr.success(<?= json_encode($flash, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>);
        });
    </script>
<?php endif; ?>

<section class="hero">
    <form method="GET" action="index.php?accion=index" style="display:flex; flex-direction: row; justify-content: center; align-items: center; gap:10px">
        <input type="text" name="filtro" placeholder="Introduce parte del nombre a buscar">
        <select name="curso">
            <?php
            // echo "<option value=''>Cualquiera</option>";
            // foreach ($options as $optionSel) {
            //     echo "<option value='$optionSel'>$optionSel</option>";
            // }
            ?>

            <option value=''>Cualquiera</option>
            <?php foreach ($options as $optionSel): ?>
                <option value='<?= $optionSel ?>'><?= $optionSel ?></option>
            <?php endforeach; ?>
        </select>
        <button class="button button-primary" type="submit">Filtrar</button>
    </form>

</section>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2>Listado</h2>
            <p><?= count($alumnos) ?> alumno<?= count($alumnos) === 1 ? '' : 's' ?> registrado<?= count($alumnos) === 1 ? '' : 's' ?></p>
        </div>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Es friki</th>
                    <th>Nota media</th>
                    <th>Curso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($alumnos === []): ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <strong>No hay alumnos registrados.</strong>
                                <span>Empieza creando el primero desde el botón superior.</span>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($alumnos as $alumno): ?>
                        <tr>
                            <td><img src="<?= e($alumno->getAvatar()) ?>" width="60px" /></td>
                            <td>#<?= e($alumno->getId()) ?></td>
                            <td><?= e($alumno->getNombre()) ?></td>
                            <td><?= e($alumno->getEmail()) ?></td>
                            <td><?= e($alumno->getEdad()) ?></td>
                            <td><?= e($alumno->getEsfriki() == false ? "NO" : "SÍ") ?></td>
                            <td><?= e($alumno->getNota()) ?></td>
                            <td><span class="badge"><?= e($alumno->getCurso()) ?></span></td>
                            <td>
                                <div class="actions">
                                    <a class="button button-secondary" href="index.php?accion=editar&id=<?= e($alumno->getId()) ?>">Editar</a>
                                    <a
                                        class="button button-danger"
                                        href="index.php?accion=eliminar&id=<?= e($alumno->getId()) ?>"
                                        onclick="return confirm('¿Seguro que quieres eliminar este alumno?');">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require __DIR__ . '/../partials/footer.php'; ?>