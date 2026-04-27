<?php

declare(strict_types=1);

namespace App\models;

use App\lib\Database;
use PDO;

final class Usuario
{
    private ?int $id = null;
    private string $nombre = '';
    private string $email = '';
    private string $password_hash = '';
    private string $rol = '';

    public static function findActiveByEmail(string $email): ?self
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $statement = $conexion->prepare(
            'SELECT id, nombre, email, password_hash, rol FROM usuarios WHERE email = :email AND activo = 1 LIMIT 1'
        );
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);

        $usuario = $statement->fetch() ?: null;

        return $usuario;
    }

    public static function validateRegistration(array $data): array
    {
        $errors = [];
        $nombre = trim((string) ($data['nombre'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $rol = trim((string) ($data['rol'] ?? ''));
        $password = (string) ($data['password'] ?? '');
        $passwordConfirmation = (string) ($data['password_confirmation'] ?? '');

        if ($nombre === '') {
            $errors[] = 'El nombre es obligatorio.';
        }

        if ($rol === '' || !in_array($rol, ['admin', 'profesor', 'editor'])) {
            $errors[] = 'Debes seleccionar un rol válido.';
        }

        if ($email === '') {
            $errors[] = 'El email es obligatorio.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El email no tiene un formato válido.';
        } elseif (self::findByEmail($email) !== null) {
            $errors[] = 'Ya existe un usuario con ese email.';
        }

        if ($password === '') {
            $errors[] = 'La contraseña es obligatoria.';
        } elseif (mb_strlen($password) < 8) {
            $errors[] = 'La contraseña debe tener al menos 8 caracteres.';
        }

        if ($passwordConfirmation === '') {
            $errors[] = 'Debes repetir la contraseña.';
        } elseif ($password !== $passwordConfirmation) {
            $errors[] = 'Las contraseñas no coinciden.';
        }

        return $errors;
    }

    public static function usuarioFromRegisterData(array $data): self
    {
        $usuario = new self();
        $usuario->setNombre(trim((string) ($data['nombre'] ?? '')));
        $usuario->setEmail(trim((string) ($data['email'] ?? '')));
        $usuario->setRol(trim((string) ($data['rol'] ?? '')));
        $usuario->setPasswordHash(password_hash((string) ($data['password'] ?? ''), PASSWORD_DEFAULT));

        return $usuario;
    }

    public static function findByEmail(string $email): ?self
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $statement = $conexion->prepare(
            'SELECT id, nombre, email, password_hash, rol FROM usuarios WHERE email = :email LIMIT 1'
        );
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);

        $usuario = $statement->fetch() ?: null;

        return $usuario;
    }

    public static function registerSuccessfulLogin(int $id): void
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return;
        }

        $statement = $conexion->prepare('UPDATE usuarios SET ultimo_login = NOW() WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    public function insert(): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $statement = $conexion->prepare(
            'INSERT INTO usuarios (nombre, email, password_hash, rol) VALUES (:nombre, :email, :password_hash, :rol)'
        );

        $saved = $statement->execute([
            'nombre' => $this->getNombre(),
            'email' => $this->getEmail(),
            'password_hash' => $this->getPasswordHash(),
            'rol' => $this->getRol(),
        ]);

        return $saved;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->password_hash = $passwordHash;
    }

    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->password_hash;
    }

    public function getRol(): string
    {
        return $this->rol;
    }
}
