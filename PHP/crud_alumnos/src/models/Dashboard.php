<?php

declare(strict_types=1);

namespace App\models;

use App\lib\Database;
use PDO;

final class Dashboard
{

    public static function getTotalAlumnos()
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return null;
        }

        $sql = 'SELECT count(*) as total FROM alumnos';
        $resultado = $conexion->query($sql);
        $totalAlumnos = 0;
        foreach ($resultado as $fila) {
            $totalAlumnos = $fila['total'];
            break;
        }


        return $totalAlumnos;
    }

    public static function getNotaMedia()
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return [];
        }

        $sql = 'SELECT AVG(alumnos.nota) as total FROM alumnos';
        $resultado = $conexion->query($sql);
        $totalNotas = 0;
        foreach ($resultado as $fila) {
            $totalNotas = $fila['total'];
            break;
        }
        return $totalNotas;
    }

    public static function getFrikisTotales()
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return [];
        }

        $sql = 'SELECT count(*) as total FROM alumnos WHERE alumnos.esfriki = 1 ';
        $resultado = $conexion->query($sql);
        $totalNotas = 0;
        foreach ($resultado as $fila) {
            $totalNotas = $fila['total'];
            break;
        }
        return $totalNotas;
    }

    public static function getSuperCurso()
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return [];
        }
        $sql = "SELECT curso, count(*) as total FROM `alumnos` GROUP by alumnos.curso having count(*) >= ALL(SELECT count(*) as total FROM `alumnos` GROUP by alumnos.curso )";
        $resultado = $conexion->query($sql);
        foreach ($resultado as $fila) {
            $totalMatriculados = $fila['total'];
            $mejorCurso = $fila['curso'];
            break;
        }

        return ["totalMatriculados" => $totalMatriculados, "mejorCurso" => $mejorCurso];
    }

    public static function getSumaNotas()
    {
        $conexion = Database::conectar();
        if ($conexion === null) {
            return [];
        }

        $sql = 'SELECT SUM(alumnos.nota) as total FROM alumnos';
        $resultado = $conexion->query($sql);
        $totalNotas = 0;
        foreach ($resultado as $fila) {
            $totalNotas = $fila['total'];
            break;
        }
        return $totalNotas;
    }
}
