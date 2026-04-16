<?php

declare(strict_types=1);

namespace App\models;

use App\lib\Database;
use PDO;

final class Alumno
{
    private ?int $id = null;
    private string $nombre = '';
    private string $email = '';
    private int $edad = 0;
    private string $curso = '';
    private bool $esfriki = false;

    // Crea un objeto Alumno a partir de los datos recibidos desde el formulario.
    public static function alumnoFromPost(array $data): self
    {
        // Convierte los datos enviados por el formulario en un objeto Alumno ya tipado.
        $alumno = new self();
        $alumno->setNombre(trim((string) ($data['nombre'] ?? '')));
        $alumno->setEmail(trim((string) ($data['email'] ?? '')));
        $alumno->setEdad(isset($data['edad']) && $data['edad'] !== '' ? (int) $data['edad'] : 18);
        $alumno->setCurso(trim((string) ($data['curso'] ?? '')));
        $alumno->setEsfriki((bool) ($data['esfriki'] ?? false));
        return $alumno;
    }

    // Obtiene todos los alumnos de la base de datos ordenados por nombre.
    public static function all(): array
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return [];
        }

        $sql = 'SELECT * FROM alumnos ORDER BY nombre ASC';
        $statement = $conexion->query($sql);

        // FETCH_CLASS hace que cada fila se convierta automaticamente en un objeto Alumno.
        $alumnos = $statement->fetchAll(PDO::FETCH_CLASS, Alumno::class);

        return $alumnos;
    }

    // Busca un alumno concreto por su id y lo devuelve como objeto.
    public static function find(int $id): ?self
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $sql = 'SELECT * FROM alumnos WHERE id = :id';
        $statement = $conexion->prepare($sql);
        $statement->execute(['id' => $id]);
        // Indicamos a PDO que el unico resultado debe devolverse como objeto Alumno.
        $statement->setFetchMode(PDO::FETCH_CLASS, Alumno::class);

        $resultado = $statement->fetch();
        $alumno = $resultado instanceof self ? $resultado : null;

        return $alumno;
    }

    // Inserta en la base de datos los datos del alumno actual.
    public function insert(): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $statement = $conexion->prepare(
            'INSERT INTO alumnos (nombre, email, edad, curso, esfriki) VALUES (:nombre, :email, :edad, :curso, :esfriki)'
        );

        // execute() rellena los marcadores :nombre, :email... con estos valores de forma segura.
        $saved = $statement->execute([
            'nombre' => $this->getNombre(),
            'email' => $this->getEmail(),
            'edad' => $this->getEdad(),
            'curso' => $this->getCurso(),
            'esfriki' => (int) $this->getEsfriki(),
        ]);
        if ($saved) {
            $this->setId((int) $conexion->lastInsertId());
        }

        return $saved;
    }

    // Actualiza en la base de datos el registro del alumno actual.
    public function update(): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $statement = $conexion->prepare(
            'UPDATE alumnos SET nombre = :nombre, email = :email, edad = :edad, curso = :curso WHERE id = :id'
        );

        $updated = $statement->execute([
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'email' => $this->getEmail(),
            'edad' => $this->getEdad(),
            'curso' => $this->getCurso(),
        ]);

        return $updated;
    }

    // Elimina de la base de datos el alumno cuyo id se recibe como parametro.
    public static function delete(int $id): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $statement = $conexion->prepare('DELETE FROM alumnos WHERE id = :id');
        $deleted = $statement->execute(['id' => $id]);

        return $deleted;
    }

    // Comprueba que los datos del formulario cumplen las reglas basicas de validacion.
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

    // Comprueba si ya existe otro alumno con el mismo email en la base de datos.
    private static function emailExists(string $email, ?int $ignoreId = null): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $sql = 'SELECT COUNT(*) FROM alumnos WHERE email = :email';
        $params = ['email' => $email];

        // En edicion excluimos el propio id para no detectar como duplicado el mismo registro.
        if ($ignoreId !== null) {
            $sql .= ' AND id != :id';
            $params['id'] = $ignoreId;
        }

        $statement = $conexion->prepare($sql);
        $statement->execute($params);
        $totalCoincidencias = (int) $statement->fetchColumn();
        $emailExiste = $totalCoincidencias > 0;

        return $emailExiste;
    }

    public function getEsfriki(): bool
    {
        return $this->esfriki;
    }

    public function setEsfriki(bool $esfriki): self
    {
        $this->esfriki = $esfriki;

        return $this;
    }
}
