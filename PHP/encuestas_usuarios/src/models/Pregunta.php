<?php

namespace App\models;

use App\lib\Database;
use PDO;

class Pregunta
{
    private ?int $id = null;
    private string $texto = '';
    private bool $activa = true;

    public static function obtenerActiva(): ?self
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $statement = $conexion->query('SELECT * FROM preguntas WHERE activa = 1 ORDER BY id DESC LIMIT 1');
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);

        $resultado = $statement->fetch();

        return $resultado instanceof self ? $resultado : null;
    }

    public static function find(int $id): ?self
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $statement = $conexion->prepare('SELECT * FROM preguntas WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);

        $resultado = $statement->fetch();

        return $resultado instanceof self ? $resultado : null;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): void
    {
        $this->texto = $texto;
    }

    public function isActiva(): bool
    {
        return $this->activa;
    }

    public function setActiva(bool $activa): void
    {
        $this->activa = $activa;
    }
}
