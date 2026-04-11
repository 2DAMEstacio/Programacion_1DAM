<?php

declare(strict_types=1);

namespace App\models;

use App\lib\Database;
use PDO;

final class Alumno
{
    private ?int $id;
    private string $nombre;
    private string $email;
    private int $edad;
    private string $curso;

    public function __construct(
        ?int $id = null,
        string $nombre = '',
        string $email = '',
        int $edad = 18,
        string $curso = ''
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->edad = $edad;
        $this->curso = $curso;
    }

    public static function all(): array
    {
        $conexion = Database::conectar();
        if (!$conexion instanceof PDO) {
            return [];
        }

        $statement = $conexion->query('SELECT id, nombre, email, edad, curso FROM alumnos ORDER BY nombre ASC');

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

        return array_map(static fn (array $row): self => self::fromArray($row), $rows);
    }

    public static function find(int $id): ?self
    {
        $conexion = Database::conectar();
        if (!$conexion instanceof PDO) {
            return null;
        }

        $statement = $conexion->prepare('SELECT id, nombre, email, edad, curso FROM alumnos WHERE id = :id');
        $statement->execute(['id' => $id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $row === false ? null : self::fromArray($row);
    }

    public function insert(): bool
    {
        $conexion = Database::conectar();
        if (!$conexion instanceof PDO) {
            return false;
        }

        $statement = $conexion->prepare(
            'INSERT INTO alumnos (nombre, email, edad, curso) VALUES (:nombre, :email, :edad, :curso)'
        );

        $saved = $statement->execute($this->toDatabaseArray());
        if ($saved) {
            $this->setId((int) $conexion->lastInsertId());
        }

        return $saved;
    }

    public function update(): bool
    {
        $conexion = Database::conectar();
        if (!$conexion instanceof PDO) {
            return false;
        }

        $statement = $conexion->prepare(
            'UPDATE alumnos SET nombre = :nombre, email = :email, edad = :edad, curso = :curso WHERE id = :id'
        );

        return $statement->execute($this->toDatabaseArray(includeId: true));
    }

    public static function delete(int $id): bool
    {
        $conexion = Database::conectar();
        if (!$conexion instanceof PDO) {
            return false;
        }

        $statement = $conexion->prepare('DELETE FROM alumnos WHERE id = :id');

        return $statement->execute(['id' => $id]);
    }

    public static function validate(array $data, ?int $ignoreId = null): array
    {
        $errors = [];
        $nombre = trim((string) ($data['nombre'] ?? ''));
        $email = trim((string) ($data['email'] ?? ''));
        $curso = trim((string) ($data['curso'] ?? ''));
        $edad = $data['edad'] ?? null;

        if ($nombre === '') {
            $errors[] = 'El nombre es obligatorio.';
        }

        if ($email === '') {
            $errors[] = 'El email es obligatorio.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'El email no tiene un formato válido.';
        } elseif (self::emailExists($email, $ignoreId)) {
            $errors[] = 'Ya existe otro alumno con ese email.';
        }

        if ($edad === null || $edad === '') {
            $errors[] = 'La edad es obligatoria.';
        } elseif (!filter_var((string) $edad, FILTER_VALIDATE_INT)) {
            $errors[] = 'La edad debe ser un número entero.';
        } elseif ((int) $edad < 16 || (int) $edad > 99) {
            $errors[] = 'La edad debe estar entre 16 y 99.';
        }

        if ($curso === '') {
            $errors[] = 'El curso es obligatorio.';
        }

        return $errors;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: isset($data['id']) ? (int) $data['id'] : null,
            nombre: (string) ($data['nombre'] ?? ''),
            email: (string) ($data['email'] ?? ''),
            edad: isset($data['edad']) ? (int) $data['edad'] : 18,
            curso: (string) ($data['curso'] ?? '')
        );
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

    public function getEdad(): int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): void
    {
        $this->edad = $edad;
    }

    public function getCurso(): string
    {
        return $this->curso;
    }

    public function setCurso(string $curso): void
    {
        $this->curso = $curso;
    }

    private function toDatabaseArray(bool $includeId = false): array
    {
        $payload = [
            'nombre' => $this->getNombre(),
            'email' => $this->getEmail(),
            'edad' => $this->getEdad(),
            'curso' => $this->getCurso(),
        ];

        if ($includeId) {
            $payload['id'] = $this->getId();
        }

        return $payload;
    }

    private static function emailExists(string $email, ?int $ignoreId = null): bool
    {
        $conexion = Database::conectar();
        if (!$conexion instanceof PDO) {
            return false;
        }

        $sql = 'SELECT COUNT(*) FROM alumnos WHERE email = :email';
        $params = ['email' => $email];

        if ($ignoreId !== null) {
            $sql .= ' AND id != :id';
            $params['id'] = $ignoreId;
        }

        $statement = $conexion->prepare($sql);
        $statement->execute($params);

        return (int) $statement->fetchColumn() > 0;
    }
}
