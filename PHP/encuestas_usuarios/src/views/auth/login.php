<section class="card">
    <h2>Iniciar sesión</h2>

    <form action="index.php?action=doLogin" method="POST" class="form">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Entrar</button>
    </form>

    <p>¿No tienes cuenta? <a href="index.php?action=registro">Regístrate</a></p>
</section>
