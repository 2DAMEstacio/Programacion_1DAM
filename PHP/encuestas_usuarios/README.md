# Sistema de Encuestas con Usuarios Registrados

Actividad de aula para practicar PHP, MVC, Composer, formularios, sesiones, PDO y MySQL a partir de una aplicación sencilla de encuestas.

## Requisitos

- PHP 8.1 o superior
- Composer 2
- MySQL o MariaDB
- Extensión `pdo_mysql` habilitada

## Dependencias

Este proyecto utiliza Composer y actualmente incluye:

- `vlucas/phpdotenv` para cargar variables de entorno desde `.env`
- `bower-asset/toastr` para mostrar notificaciones en la interfaz

Instalación:

```bash
composer install
```

## Configuración

Crea tu archivo de configuración local a partir del ejemplo:

```bash
cp .env.example .env
```

Después revisa, como mínimo, estos valores:

- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`

## Base de datos

Importa el esquema inicial:

```bash
mysql -u root -p < database/schema.sql
```

Ese fichero crea:

- la base de datos
- las tablas de usuarios, preguntas, opciones y votos
- una encuesta inicial con varias opciones

## Ejecución

Arranca el servidor embebido de PHP:

```bash
php -S localhost:8000 -t public
```

Después abre:

```txt
http://localhost:8000
```

## Estructura del proyecto

```txt
encuestas_usuarios/
├── database/
│   └── schema.sql
├── public/
│   ├── assets/
│   │   └── style.css
│   └── index.php
├── src/
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── EncuestaController.php
│   │   └── SessionController.php
│   ├── lib/
│   │   └── Database.php
│   ├── models/
│   │   ├── Opcion.php
│   │   ├── Pregunta.php
│   │   ├── Usuario.php
│   │   └── Voto.php
│   ├── views/
│   │   ├── auth/
│   │   ├── encuestas/
│   │   └── layout/
│   └── utils.php
├── .env.example
├── composer.json
├── composer.lock
└── README.md
```

## Estado actual del proyecto

La aplicación ya incluye:

- conexión a base de datos mediante PDO
- carga de configuración desde `.env`
- modelos con acceso real a datos
- vistas de login, registro, encuesta y resultados
- gestión completa de sesión y mensajes flash

Los controladores están preparados con un enfoque didáctico:

- `SessionController` está completamente implementado
- `AuthController` y `EncuestaController` contienen comentarios guía para que el alumnado implemente la lógica

## Objetivo de la actividad

La aplicación debe permitir que:

1. Un usuario pueda registrarse.
2. Un usuario pueda iniciar sesión.
3. Solo un usuario autenticado pueda acceder a la encuesta.
4. Cada usuario pueda votar una sola vez por pregunta.
5. Se puedan consultar los resultados de la encuesta activa.

## Qué debe implementar el alumnado

### Modelos

Los modelos ya contienen una base funcional, pero se pueden utilizar como referencia para entender:

- cómo validar datos de entrada
- cómo consultar con PDO usando sentencias preparadas
- cómo convertir filas de base de datos en objetos
- cómo insertar y actualizar información

### Controladores

La parte principal de la actividad está ahora en los controladores de autenticación y encuesta.

El alumnado debe completar la lógica necesaria para:

- recoger datos de formularios
- validar entradas
- invocar a los modelos adecuados
- controlar los casos de error
- guardar mensajes flash
- redirigir entre pantallas
- cargar la interfaz con los datos necesarios

En la parte de voto, además, debe:

- comprobar si el usuario ya ha votado
- validar que la opción elegida pertenece a la pregunta recibida
- registrar el voto
- actualizar el contador de votos de la opción
- usar una transacción para que ambas operaciones se ejecuten juntas

### Vistas

Las vistas también incluyen una parte pendiente en la pantalla de resultados.

El alumnado debe calcular correctamente:

- el porcentaje de votos de cada opción
- el ancho visual de cada barra a partir de ese porcentaje

## Flujo esperado de la aplicación

1. El usuario se registra.
2. El usuario inicia sesión.
3. Accede a la encuesta activa.
4. Selecciona una opción y emite su voto.
5. Consulta los resultados agregados.
