<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EvaluacionRutina
 *
 * @ORM\Table(name="evaluacion_rutina", uniqueConstraints={@ORM\UniqueConstraint(name="rutina", columns={"rutina_ejercicio"})})
 * @ORM\Entity
 */
class EvaluacionRutina
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="evaluacion", type="integer", nullable=false)
     */
    private $evaluacion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=1000, nullable=false)
     */
    private $observacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \RutinasHasEjercicios
     *
     * @ORM\ManyToOne(targetEntity="RutinasHasEjercicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rutina_ejercicio", referencedColumnName="id")
     * })
     */
    private $rutinaEjercicio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvaluacion(): ?int
    {
        return $this->evaluacion;
    }

    public function setEvaluacion(int $evaluacion): self
    {
        $this->evaluacion = $evaluacion;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getRutinaEjercicio(): ?RutinasHasEjercicios
    {
        return $this->rutinaEjercicio;
    }

    public function setRutinaEjercicio(?RutinasHasEjercicios $rutinaEjercicio): self
    {
        $this->rutinaEjercicio = $rutinaEjercicio;

        return $this;
    }


}
