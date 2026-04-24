<?php

namespace App\models;

use App\lib\Database;

class Voto
{
    private ?int $id = null;
    private int $usuario_id = 0;
    private int $pregunta_id = 0;
    private int $opcion_id = 0;
    private ?string $fecha = null;

    public static function yaHaVotado(int $usuarioId, int $preguntaId): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $statement = $conexion->prepare(
            'SELECT COUNT(*) FROM votos WHERE usuario_id = :usuario_id AND pregunta_id = :pregunta_id'
        );
        $statement->execute([
            'usuario_id' => $usuarioId,
            'pregunta_id' => $preguntaId,
        ]);

        return (int) $statement->fetchColumn() > 0;
    }

    public static function totalPorPregunta(int $preguntaId): int
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return 0;
        }

        $statement = $conexion->prepare('SELECT COUNT(*) FROM votos WHERE pregunta_id = :pregunta_id');
        $statement->execute(['pregunta_id' => $preguntaId]);

        return (int) $statement->fetchColumn();
    }

    public function insert(): bool
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return false;
        }

        $statement = $conexion->prepare(
            'INSERT INTO votos (usuario_id, pregunta_id, opcion_id) VALUES (:usuario_id, :pregunta_id, :opcion_id)'
        );

        $guardado = $statement->execute([
            'usuario_id' => $this->getUsuarioId(),
            'pregunta_id' => $this->getPreguntaId(),
            'opcion_id' => $this->getOpcionId(),
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

    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(int $usuarioId): void
    {
        $this->usuario_id = $usuarioId;
    }

    public function getPreguntaId(): int
    {
        return $this->pregunta_id;
    }

    public function setPreguntaId(int $preguntaId): void
    {
        $this->pregunta_id = $preguntaId;
    }

    public function getOpcionId(): int
    {
        return $this->opcion_id;
    }

    public function setOpcionId(int $opcionId): void
    {
        $this->opcion_id = $opcionId;
    }

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(?string $fecha): void
    {
        $this->fecha = $fecha;
    }
}
