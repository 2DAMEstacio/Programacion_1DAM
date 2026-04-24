<?php

namespace App\models;

use App\lib\Database;
use PDO;

class Opcion
{
    private ?int $id = null;
    private int $pregunta_id = 0;
    private string $texto = '';
    private int $votos = 0;

    public static function obtenerPorPregunta(int $preguntaId): array
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return [];
        }

        $statement = $conexion->prepare('SELECT * FROM opciones WHERE pregunta_id = :pregunta_id ORDER BY id');
        $statement->execute(['pregunta_id' => $preguntaId]);

        return $statement->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function find(int $id): ?self
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $statement = $conexion->prepare('SELECT * FROM opciones WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);

        $resultado = $statement->fetch();

        return $resultado instanceof self ? $resultado : null;
    }

    public function incrementarVotos(): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null || $this->getId() === null) {
            return false;
        }

        $statement = $conexion->prepare('UPDATE opciones SET votos = votos + 1 WHERE id = :id');
        $actualizado = $statement->execute(['id' => $this->getId()]);

        if ($actualizado) {
            $this->votos++;
        }

        return $actualizado;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPreguntaId(): int
    {
        return $this->pregunta_id;
    }

    public function setPreguntaId(int $preguntaId): void
    {
        $this->pregunta_id = $preguntaId;
    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): void
    {
        $this->texto = $texto;
    }

    public function getVotos(): int
    {
        return $this->votos;
    }

    public function setVotos(int $votos): void
    {
        $this->votos = $votos;
    }
}
