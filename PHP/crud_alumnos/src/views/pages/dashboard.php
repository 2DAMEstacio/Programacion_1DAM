<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de estadísticas</title>
    <link rel="stylesheet" href="/assets/dashboard.css" />
</head>

<body>
    <main class="page-shell">
        <section class="hero">
            <div>
                <span class="eyebrow">Resumen académico</span>
                <h1>Panel de estadísticas</h1>
                <p>Consulta rápida del estado general de los alumnos registrados, agrupaciones por curso y ranking académico.</p>
            </div>
            <div style="display:flex; gap:12px;">
                <a class="button" href="index.php?accion=index">Volver al listado</a>
                <a class="button button-secondary" href="index.php?accion=logout">Cerrar sesion</a>
            </div>
        </section>

        <section class="stats-grid">
            <?= $cardTotalAlumnos ?>
            <?= $cardNotaMedia ?>
            <?= $cardAlumnosFrikis ?>
            <?= $cardCursoMasNumeroso ?>
        </section>

        <section class="layout">
            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2>Estadísticas por curso</h2>
                        <p>Resumen agrupado con número de alumnos, edad media, nota media y porcentaje de alumnos frikis.</p>
                    </div>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Total alumnos</th>
                                <th>Edad media</th>
                                <th>Nota media</th>
                                <th>% frikis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($estadisticasPorCurso as $estadisticaSeleccionada): ?>
                                <tr>
                                    <td><span class="badge"><?= $estadisticaSeleccionada->getCurso() ?></span></td>
                                    <td><?= $estadisticaSeleccionada->getTotal_alumnos() ?></td>
                                    <td><?= $estadisticaSeleccionada->getEdad_media() ?></td>
                                    <td><?= $estadisticaSeleccionada->getNota_media() ?></td>
                                    <td><?= $estadisticaSeleccionada->getFrikis() . '%' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <aside class="panel">
                <div class="panel-header">
                    <div>
                        <h2>Top 5 alumnos</h2>
                        <p>Ranking ficticio ordenado por nota descendente.</p>
                    </div>
                </div>

                <div class="ranking-list">

                    <?= $top5; ?>

                    <!-- <article class="ranking-item">
                            <div>
                                <strong>Lucía Navarro</strong>
                                <span>2DAW · 20 años</span>
                            </div>
                            <div class="score">9,8</div>
                        </article> -->
                </div>
            </aside>
        </section>
    </main>
</body>

</html>
