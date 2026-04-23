<?php

namespace App\models;

class EstadisticaClase
{
    private string $curso = "";
    private int $total_alumnos = 0;
    private float $edad_media = 0;
    private float $nota_media = 0;
    private float $frikis = 0;

    /**
     * Get the value of curso
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set the value of curso
     *
     * @return  self
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get the value of total_alumnos
     */
    public function getTotal_alumnos()
    {
        return $this->total_alumnos;
    }

    /**
     * Set the value of total_alumnos
     *
     * @return  self
     */
    public function setTotal_alumnos($total_alumnos)
    {
        $this->total_alumnos = $total_alumnos;

        return $this;
    }

    /**
     * Get the value of edad_media
     */
    public function getEdad_media()
    {
        return $this->edad_media;
    }

    /**
     * Set the value of edad_media
     *
     * @return  self
     */
    public function setEdad_media($edad_media)
    {
        $this->edad_media = $edad_media;

        return $this;
    }

    /**
     * Get the value of nota_media
     */
    public function getNota_media()
    {
        return $this->nota_media;
    }

    /**
     * Set the value of nota_media
     *
     * @return  self
     */
    public function setNota_media($nota_media)
    {
        $this->nota_media = $nota_media;

        return $this;
    }

    /**
     * Get the value of frikis
     */
    public function getFrikis()
    {
        return $this->frikis;
    }

    /**
     * Set the value of frikis
     *
     * @return  self
     */
    public function setFrikis($frikis)
    {
        $this->frikis = $frikis;

        return $this;
    }
}
