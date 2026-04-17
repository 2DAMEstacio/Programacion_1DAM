<?php

declare(strict_types=1);

namespace App\controllers;

use App\models\Alumno;
use Throwable;

final class AlumnoController
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header('Location: index.php');
            exit;
        }

        //Verificar si existe un texto en el filtro 
        $filtro = $_GET['filtro'] ?? '';
        if ($filtro == '') {
            $alumnos = Alumno::all();
        } else {
            $alumnos = Alumno::filteredByText($filtro);
        }

        $flash = SessionController::pull('flash');

        //Mostrar a la vista
        require __DIR__ . '/../views/alumnos/index.php';
    }

    public function crear(): void
    {
        $alumno = new Alumno();
        $errores = [];
        $modo = 'crear';
        $titulo = 'Nuevo alumno';

        require __DIR__ . '/../views/alumnos/form.php';
    }

    public function guardar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $errores = Alumno::validate($_POST);
        $alumno = Alumno::alumnoFromPost($_POST);


        if ($errores !== []) {
            $modo = 'crear';
            $titulo = 'Nuevo alumno';
            require __DIR__ . '/../views/alumnos/form.php';
            return;
        }

        try {
            $alumno->insert();
            SessionController::set('flash', 'Alumno creado correctamente.');
            header('Location: index.php');
            exit;
        } catch (Throwable $exception) {
            $errores[] = 'No se ha podido guardar el alumno.' . $exception->getMessage();
            $modo = 'crear';
            $titulo = 'Nuevo alumno';
            require __DIR__ . '/../views/alumnos/form.php';
        }
    }

    public function editar(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        $alumno = Alumno::find($id);

        if (!$alumno instanceof Alumno) {
            http_response_code(404);
            exit('Alumno no encontrado.');
        }

        $errores = [];
        $modo = 'editar';
        $titulo = 'Editar alumno';

        require __DIR__ . '/../views/alumnos/form.php';
    }

    public function actualizar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php');
            exit;
        }

        $id = (int) ($_POST['id'] ?? 0);
        $errores = Alumno::validate($_POST, $id);
        $alumno = Alumno::alumnoFromPost($_POST);
        $alumno->setId($id);

        if ($errores !== []) {
            $modo = 'editar';
            $titulo = 'Editar alumno';
            require __DIR__ . '/../views/alumnos/form.php';
            return;
        }

        try {
            $alumno->update();
            SessionController::set('flash', 'Alumno actualizado correctamente.');
            header('Location: index.php');
            exit;
        } catch (Throwable $exception) {
            $errores[] = 'No se ha podido actualizar el alumno.';
            $modo = 'editar';
            $titulo = 'Editar alumno';
            require __DIR__ . '/../views/alumnos/form.php';
        }
    }

    public function eliminar(): void
    {
        $id = (int) ($_GET['id'] ?? 0);

        if ($id > 0) {
            Alumno::delete($id);
            SessionController::set('flash', 'Alumno eliminado correctamente.');
        }

        header('Location: index.php');
        exit;
    }
}
