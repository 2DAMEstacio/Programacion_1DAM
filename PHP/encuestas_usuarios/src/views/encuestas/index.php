<section class="card">
    <h2>Encuesta activa</h2>

    <?php if ($pregunta === null): ?>
        <p>No hay ninguna encuesta activa.</p>
    <?php else: ?>
        <h3><?= e($pregunta->getTexto()) ?></h3>

        <?php if ($yaHaVotado): ?>
            <p>Ya has votado en esta encuesta.</p>
            <a class="button-link" href="index.php?action=resultados">Ver resultados</a>
        <?php else: ?>
            <form action="index.php?action=votar" method="POST" class="form">
                <input type="hidden" name="pregunta_id" value="<?= (int) $pregunta->getId() ?>">

                <?php foreach ($opciones as $opcion): ?>
                    <label class="radio-option">
                        <input type="radio" name="opcion_id" value="<?= (int) $opcion->getId() ?>" required>
                        <?= e($opcion->getTexto()) ?>
                    </label>
                <?php endforeach; ?>

                <button type="submit">Votar</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</section>
