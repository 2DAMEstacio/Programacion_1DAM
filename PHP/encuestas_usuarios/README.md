# Sistema de encuestas con usuarios registrados

Actividad inicial para practicar PHP, MVC, Composer, formularios, sesiones, PDO y MySQL.

## Requisitos

- PHP 8.1 o superior
- Composer 2
- MySQL o MariaDB
- Extensión `pdo_mysql` habilitada

## Estructura

```txt
encuestas_usuarios/
├── database/
│   └── schema.sql
├── public/
│   ├── index.php
│   └── assets/
│       └── style.css
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
└── README.md
```

## Puesta en marcha

```bash
composer install
cp .env.example .env
```

Edita `.env` si tu usuario, contraseña o base de datos son diferentes.

Después importa el fichero:

```txt
database/schema.sql
```

Arranca el servidor:

```bash
php -S localhost:8000 -t public
```

Abre:

```txt
http://localhost:8000
```

## Objetivo de la actividad

Completar una aplicación en la que:

1. Un usuario pueda registrarse.
2. Un usuario pueda iniciar sesión.
3. Solo los usuarios autenticados puedan votar.
4. Cada usuario solo pueda votar una vez por encuesta.
5. Se puedan consultar los resultados.

## Tareas para el alumnado

### 1. Completar `src/models/Usuario.php`

- `registrar()`
- `buscarPorEmail()`
- `validarLogin()`

Debe usarse:

- `password_hash()`
- `password_verify()`
- consultas preparadas con PDO

### 2. Completar `src/models/Voto.php`

- `yaHaVotado()`
- `registrarVoto()`

La tabla `votos` tiene esta restricción:

```sql
UNIQUE(usuario_id, pregunta_id)
```

Esto impide que un usuario vote dos veces en la misma encuesta.

### 3. Completar `src/models/Opcion.php`

- `incrementarVotos()`

Debe sumar 1 voto a la opción seleccionada.

### 4. Completar `src/controllers/EncuestaController.php`

En el método `votar()` hay que:

1. Comprobar que el usuario no haya votado.
2. Registrar el voto.
3. Incrementar el contador de votos.
4. Usar una transacción.

### 5. Completar `src/views/encuestas/resultados.php`

Calcular el porcentaje real de votos de cada opción.

## Ampliaciones posibles

- Crear varias encuestas.
- Añadir panel de administración.
- Permitir crear preguntas y opciones desde formularios.
- Mostrar gráficos con JavaScript.
- Añadir fecha de cierre de encuesta.
