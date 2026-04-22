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
            <a class="button" href="index.php?accion=index">Volver al listado</a>
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
                            <tr>
                                <td><span class="badge">1DAM</span></td>
                                <td>8</td>
                                <td>19,8</td>
                                <td>7,10</td>
                                <td>37,5%</td>
                            </tr>
                            <tr>
                                <td><span class="badge">2DAM</span></td>
                                <td>6</td>
                                <td>20,6</td>
                                <td>6,92</td>
                                <td>33,3%</td>
                            </tr>
                            <tr>
                                <td><span class="badge">1DAW</span></td>
                                <td>5</td>
                                <td>18,9</td>
                                <td>6,40</td>
                                <td>20,0%</td>
                            </tr>
                            <tr>
                                <td><span class="badge">2DAW</span></td>
                                <td>4</td>
                                <td>21,2</td>
                                <td>7,35</td>
                                <td>50,0%</td>
                            </tr>
                            <tr>
                                <td><span class="badge">1ASIR</span></td>
                                <td>3</td>
                                <td>20,3</td>
                                <td>6,05</td>
                                <td>33,3%</td>
                            </tr>
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
                    <article class="ranking-item">
                        <div>
                            <strong>Lucía Navarro</strong>
                            <span>2DAW · 20 años</span>
                        </div>
                        <div class="score">9,8</div>
                    </article>

                    <article class="ranking-item">
                        <div>
                            <strong>Sergio Ruiz</strong>
                            <span>2DAM · 21 años</span>
                        </div>
                        <div class="score">9,4</div>
                    </article>

                    <article class="ranking-item">
                        <div>
                            <strong>Marta López</strong>
                            <span>1DAM · 19 años</span>
                        </div>
                        <div class="score">8,9</div>
                    </article>

                    <article class="ranking-item">
                        <div>
                            <strong>David Torres</strong>
                            <span>1ASIR · 22 años</span>
                        </div>
                        <div class="score">8,7</div>
                    </article>

                    <article class="ranking-item">
                        <div>
                            <strong>Carla Pérez</strong>
                            <span>1DAW · 18 años</span>
                        </div>
                        <div class="score">8,5</div>
                    </article>
                </div>
            </aside>
        </section>
    </main>
</body>

</html>