<?php

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
            $rootPath = __DIR__ . '/../..';

            if (file_exists($rootPath . '/.env')) {
                $dotenv = Dotenv::createImmutable($rootPath);
                $dotenv->load();
            }

            $servidor = $_ENV['DB_HOST'] ?? 'localhost';
            $puerto = $_ENV['DB_PORT'] ?? '3306';
            $nombreBaseDatos = $_ENV['DB_DATABASE'] ?? 'encuestas_usuarios';
            $usuario = $_ENV['DB_USERNAME'] ?? 'root';
            $contrasena = $_ENV['DB_PASSWORD'] ?? '';

            try {
                $dsn = "mysql:host={$servidor};port={$puerto};dbname={$nombreBaseDatos};charset=utf8mb4";
                self::$conexion = new PDO($dsn, $usuario, $contrasena);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                throw new PDOException('Error de conexión a la base de datos: ' . $e->getMessage(), (int) $e->getCode(), $e);
            }
        }

        return self::$conexion;
    }

    public static function getConnection(): ?PDO
    {
        return self::conectar();
    }
}
