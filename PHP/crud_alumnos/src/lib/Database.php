<?php

declare(strict_types=1);

namespace App\lib;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database
{
    private static ?PDO $conexion = null;

    public static function conectar(): ?PDO
    {
        if (self::$conexion === null) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            $servidor = $_ENV['DB_HOST'] ?? $_SERVER['DB_HOST'] ?? 'localhost';
            $puerto = $_ENV['DB_PORT'] ?? $_SERVER['DB_PORT'] ?? '3306';
            $nombreBaseDatos = $_ENV['DB_DATABASE'] ?? $_SERVER['DB_DATABASE'] ?? 'mi_base';
            $usuario = $_ENV['DB_USERNAME'] ?? $_SERVER['DB_USERNAME'] ?? 'root';
            $contrasena = $_ENV['DB_PASSWORD'] ?? $_SERVER['DB_PASSWORD'] ?? '';

            try {
                $dsn = "mysql:host={$servidor};port={$puerto};dbname={$nombreBaseDatos};charset=utf8mb4";
                self::$conexion = new PDO($dsn, $usuario, $contrasena);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo 'Error de conexión a la base de datos: ' . $e->getMessage();
                return null;
            }
        }

        return self::$conexion;
    }
}
