<section class="card">
    <h2>Resultados</h2>

    <?php if ($pregunta === null): ?>
        <p>No hay resultados disponibles.</p>
    <?php else: ?>
        <h3><?= e($pregunta->getTexto()) ?></h3>
        <p>Total de votos: <?= (int) $totalVotos ?></p>

        <?php foreach ($opciones as $opcion): ?>
            <?php
                $porcentaje = $totalVotos > 0 ? ($opcion->getVotos() / $totalVotos) * 100 : 0;
            ?>
            <div class="result-row">
                <strong><?= e($opcion->getTexto()) ?></strong>
                <span><?= (int) $opcion->getVotos() ?> votos · <?= round($porcentaje, 2) ?>%</span>
                <div class="bar">
                    <div class="bar-fill" style="width: <?= round($porcentaje, 2) ?>%"></div>
                </div>
            </div>
        <?php endforeach; ?>

        <a class="button-link" href="index.php?action=encuesta">Volver</a>
    <?php endif; ?>
</section>
