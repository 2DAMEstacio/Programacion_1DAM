<?php

namespace App\controllers;

class SessionController
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login(int $usuarioId, string $nombre): void
    {
        self::start();
        $_SESSION['usuario_id'] = $usuarioId;
        $_SESSION['usuario_nombre'] = $nombre;
    }

    public static function logout(): void
    {
        self::start();
        session_destroy();
    }

    public static function usuarioId(): ?int
    {
        self::start();
        return isset($_SESSION['usuario_id']) ? (int) $_SESSION['usuario_id'] : null;
    }

    public static function usuarioNombre(): ?string
    {
        self::start();
        return $_SESSION['usuario_nombre'] ?? null;
    }

    public static function requireLogin(): void
    {
        if (self::usuarioId() === null) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public static function flash(string $tipo, string $mensaje): void
    {
        self::start();
        $_SESSION['flash'] = ['tipo' => $tipo, 'mensaje' => $mensaje];
    }

    public static function getFlash(): ?array
    {
        self::start();
        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);
        return $flash;
    }
}
