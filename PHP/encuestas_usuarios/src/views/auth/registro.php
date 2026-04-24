<section class="card">
    <h2>Registro de usuario</h2>

    <form action="index.php?action=doRegistro" method="POST" class="form">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Crear cuenta</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="index.php?action=login">Inicia sesión</a></p>
</section>
