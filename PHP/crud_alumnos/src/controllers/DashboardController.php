<?php

namespace App\controllers;

use App\models\Dashboard;

final class DashboardController
{

    public function resumen()
    {
        $sumaTotalNotas = Dashboard::getSumaNotas();
        $totalAlumnos = Dashboard::getTotalAlumnos();
        $mediaNota = Dashboard::getNotaMedia();
        $totalFrikis = Dashboard::getFrikisTotales();
        $porcientoFrikis = round(($totalFrikis * 100) / $totalAlumnos, 2);
        $datosSuperCurso = Dashboard::getSuperCurso();

        $cardTotalAlumnos = $this->getCardTotal("Total Alumnos",  $totalAlumnos, "Registros activos en la base de datos");
        $cardNotaMedia = $this->getCardTotal("Nota media global",  round($mediaNota, 2), "Promedio calculado sobre todos los alumnos");
        $cardAlumnosFrikis = $this->getCardTotal("Alumnos frikis", $totalFrikis, "$porcientoFrikis% del total registrado");
        $cardCursoMasNumeroso = $this->getCardTotal("Curso más numeroso", $datosSuperCurso["mejorCurso"], $datosSuperCurso["totalMatriculados"] . " alumnos matriculados");
        $estadisticasPorCurso = Dashboard::getEstadisticas();

        $top5 = $this->getTopAlumnosTable();

        //$top5 = [$this->rowTop(), $this->rowTop(), $this->rowTop(), $this->rowTop(), $this->rowTop()];
        require __DIR__ . '/../views/pages/dashboard.php';
    }

    private function getCardTotal($titleCard, $valueCard, $descriptionCard)
    {
        ob_start();
        $title = $titleCard;
        $value = $valueCard;
        $description = $descriptionCard;
        require __DIR__ . '/../views/dashboard/card_total.php';
        return ob_get_clean();
    }

    private function getTopAlumnosTable()
    {
        $stringTopAlumnosTable = "";
        $infoTopAlumnos = Dashboard::getTopAlumnos();
        foreach ($infoTopAlumnos as $alumnoTopSel) {
            ob_start();
            // $nombre = $alumnoTopSel["nombre"];
            // $edad = $alumnoTopSel["edad"];
            // $curso = $alumnoTopSel["curso"];
            // $nota = $alumnoTopSel["nota"];
            require __DIR__ . '/../views/dashboard/row_top.php';
            $stringTopAlumnosTable .= ob_get_clean();
        }



        return $stringTopAlumnosTable;
    }
}
