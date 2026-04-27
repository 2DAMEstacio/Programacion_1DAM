# CRUD de alumnos con Composer y MySQL

Proyecto MVC en PHP con Composer, `.env`, MySQL, entidad `Alumno` con getters y setters, gestión de sesión centralizada y notificaciones flash más cuidadas.

## Requisitos

- PHP 8.1 o superior
- Extensión `pdo_mysql` habilitada
- Composer 2
- MySQL o MariaDB

## Estructura

- `public/`: punto de entrada y assets públicos
- `src/controllers/`: controladores de aplicación y sesión
- `src/lib/`: acceso a base de datos
- `src/models/`: entidades y lógica de datos
- `src/views/`: vistas
- `src/utils.php`: funciones auxiliares globales
- `database/schema.sql`: esquema y datos iniciales para MySQL

## Puesta en marcha

```bash
composer install
composer dump-autoload
php -S localhost:8000 -t public
```

Después abre `http://localhost:8000`.

## Configuración

El proyecto incluye `.env` y `.env.example` con esta configuración base:

```dotenv
APP_NAME="CRUD Alumnos"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=mi_base
DB_USERNAME=root
DB_PASSWORD=
```

## Base de datos

- La aplicación trabaja con MySQL.
- Importa `database/schema.sql` en tu servidor MySQL o MariaDB.
- Importa también `database/users.sql` para crear la tabla `usuarios` y el usuario demo de acceso.
- El esquema crea la base `mi_base`, la tabla `alumnos` y varios registros de ejemplo.

## Acceso a la aplicación

- Todas las pantallas del CRUD y del dashboard quedan protegidas por sesión.
- Usuario demo: `admin@centro.local`
- Contraseña demo: `admin1234`

## Arquitectura actual

- `App\lib\Database`: conexión PDO reutilizable a MySQL
- `App\models\Alumno`: entidad con atributos privados, getters, setters y operaciones CRUD
- `App\controllers\AlumnoController`: flujo del CRUD
- `App\controllers\SessionController`: arranque y acceso centralizado a sesión

## Mensajes flash

Los mensajes flash se guardan en sesión y se muestran como popup autocerrable con `toastr`, instalado mediante Composer.

## Nota importante

Si PHP no tiene `pdo_mysql` correctamente instalado o activado, la aplicación no podrá conectar con MySQL.
