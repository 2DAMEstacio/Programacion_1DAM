<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso | CRUD Alumnos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/auth-example.css">
</head>
<body>
    <main class="page-shell auth-shell">
        <section class="auth-layout">
            <article class="panel auth-hero">
                <div>
                    <span class="eyebrow">Zona privada</span>
                    <h1>Accede o crea tu cuenta en segundos.</h1>
                    <p>Ejemplo de pantalla de autenticacion para la app. El bloque izquierdo sirve como presentacion y los formularios de la derecha muestran el login y el alta de nuevos usuarios.</p>
                </div>

                <div class="auth-feature-list">
                    <div class="auth-feature">
                        <span class="auth-dot" aria-hidden="true"></span>
                        <div>
                            <strong>Inicio de sesion simple</strong>
                            <p>Acceso con email y contrasena, con opcion para recordar la cuenta y recuperar el acceso.</p>
                        </div>
                    </div>
                    <div class="auth-feature">
                        <span class="auth-dot" aria-hidden="true"></span>
                        <div>
                            <strong>Registro guiado</strong>
                            <p>Formulario claro con nombre, email, rol y contrasena para dar de alta usuarios rapidamente.</p>
                        </div>
                    </div>
                    <div class="auth-feature">
                        <span class="auth-dot" aria-hidden="true"></span>
                        <div>
                            <strong>Preparado para integrarlo</strong>
                            <p>La estructura usa clases reutilizables del proyecto, asi que se puede convertir en una vista PHP sin rehacer el diseno.</p>
                        </div>
                    </div>
                </div>

                <span class="auth-legend">Demo visual para login y registro</span>
            </article>

            <div class="auth-stack">
                <section class="panel auth-card">
                    <div class="panel-header">
                        <div>
                            <h2>Iniciar sesion</h2>
                            <p>Introduce tus credenciales para entrar al panel.</p>
                        </div>
                    </div>

                    <?php if ($flash !== null): ?>
                        <div class="notice success">
                            <?= e($flash) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($loginError !== null): ?>
                        <div class="notice error">
                            <?= e($loginError) ?>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?accion=autenticar" method="post">
                        <label for="login-email">
                            Correo electronico
                            <input id="login-email" name="email" type="email" placeholder="admin@centro.local" value="<?= e($loginEmail) ?>" required>
                        </label>

                        <label for="login-password">
                            Contrasena
                            <input id="login-password" name="password" type="password" placeholder="Tu contrasena" required>
                        </label>

                        <div class="auth-help">
                            <label for="remember-user">
                                <input id="remember-user" name="remember" type="checkbox">
                                Recordarme en este equipo
                            </label>
                            <a href="#">He olvidado mi contrasena</a>
                        </div>

                        <div class="form-actions">
                            <button class="button button-primary" type="submit">Entrar</button>
                            <a class="button button-secondary" href="#registro">Ver registro</a>
                        </div>
                    </form>
                </section>

                <section id="registro" class="panel auth-card">
                    <div class="panel-header">
                        <div>
                            <h2>Crear cuenta</h2>
                            <p>Alta rapida para administradores, profesores o personal autorizado.</p>
                        </div>
                    </div>

                    <?php if ($registerErrors !== []): ?>
                        <div class="notice error">
                            <strong>Revisa el formulario de alta.</strong>
                            <ul>
                                <?php foreach ($registerErrors as $error): ?>
                                    <li><?= e($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="index.php?accion=registrar" method="post">
                        <div class="auth-field-row">
                            <label for="register-name">
                                Nombre completo
                                <input id="register-name" name="nombre" type="text" placeholder="Ana Perez" value="<?= e($registerData['nombre']) ?>" required>
                            </label>

                            <label for="register-role">
                                Rol
                                <select id="register-role" name="rol" required>
                                    <option value="">Selecciona un rol</option>
                                    <option value="admin" <?= $registerData['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                                    <option value="profesor" <?= $registerData['rol'] === 'profesor' ? 'selected' : '' ?>>Profesor</option>
                                    <option value="editor" <?= $registerData['rol'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                                </select>
                            </label>
                        </div>

                        <label for="register-email">
                            Correo electronico
                            <input id="register-email" name="email" type="email" placeholder="ana@centro.local" value="<?= e($registerData['email']) ?>" required>
                        </label>

                        <div class="auth-field-row">
                            <label for="register-password">
                                Contrasena
                                <input id="register-password" name="password" type="password" placeholder="Minimo 8 caracteres" required>
                            </label>

                            <label for="register-password-confirm">
                                Repetir contrasena
                                <input id="register-password-confirm" name="password_confirmation" type="password" placeholder="Repite la contrasena" required>
                            </label>
                        </div>

                        <div class="form-actions">
                            <button class="button button-primary" type="submit">Crear usuario</button>
                            <button class="button button-secondary" type="reset">Limpiar</button>
                        </div>
                    </form>
                </section>
            </div>
        </section>
    </main>
</body>
</html>
