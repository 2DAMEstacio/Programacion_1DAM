<?php

namespace App\models;

use App\lib\Database;
use PDO;

class Usuario
{
    private ?int $id = null;
    private string $nombre = '';
    private string $email = '';
    private string $password = '';

    public static function usuarioFromPost(array $postInfo): self
    {
        $usuario = new self();
        $usuario->setNombre(trim((string) ($postInfo['nombre'] ?? '')));
        $usuario->setEmail(trim((string) ($postInfo['email'] ?? '')));
        $usuario->setPassword((string) ($postInfo['password'] ?? ''));

        return $usuario;
    }

    public static function findByEmail(string $email): ?self
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $statement = $conexion->prepare('SELECT * FROM usuarios WHERE email = :email LIMIT 1');
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);

        $resultado = $statement->fetch();

        return $resultado instanceof self ? $resultado : null;
    }

    public static function validarLogin(string $email, string $password): ?self
    {
        $usuario = self::findByEmail($email);
        if (!$usuario instanceof self) {
            return null;
        }

        if (!password_verify($password, $usuario->getPassword())) {
            return null;
        }

        return $usuario;
    }

    public static function validate(array $data): array
    {
        $errores = [];
        $nombre = trim((string) ($data['nombre'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $password = (string) ($data['password'] ?? '');

        if ($nombre === '') {
            $errores[] = 'El nombre es obligatorio.';
        }

        if ($email === '') {
            $errores[] = 'El email es obligatorio.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = 'El email no tiene un formato válido.';
        } elseif (self::findByEmail($email) instanceof self) {
            $errores[] = 'Ya existe un usuario con ese email.';
        }

        if ($password === '') {
            $errores[] = 'La contraseña es obligatoria.';
        }

        return $errores;
    }

    public function insert(): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $statement = $conexion->prepare(
            'INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)'
        );

        $guardado = $statement->execute([
            'nombre' => $this->getNombre(),
            'email' => $this->getEmail(),
            'password' => password_hash($this->getPassword(), PASSWORD_DEFAULT),
        ]);

        if ($guardado) {
            $this->setId((int) $conexion->lastInsertId());
        }

        return $guardado;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
