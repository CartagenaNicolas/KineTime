<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RutinasHasEjercicios
 *
 * @ORM\Table(name="rutinas_has_ejercicios", indexes={@ORM\Index(name="fk_rutinas_has_ejercicios_ejercicios", columns={"ejercicio_id"}), @ORM\Index(name="fk_rutinas_has_ejercicios_rutinas", columns={"rutina_id"})})
 * @ORM\Entity
 */
class RutinasHasEjercicios
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
     * @var \Ejercicio
     *
     * @ORM\ManyToOne(targetEntity="Ejercicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ejercicio_id", referencedColumnName="id")
     * })
     */
    private $ejercicio;

    /**
     * @var \Rutina
     *
     * @ORM\ManyToOne(targetEntity="Rutina")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rutina_id", referencedColumnName="id")
     * })
     */
    private $rutina;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEjercicio(): ?Ejercicio
    {
        return $this->ejercicio;
    }

    public function setEjercicio(?Ejercicio $ejercicio): self
    {
        $this->ejercicio = $ejercicio;

        return $this;
    }

    public function getRutina(): ?Rutina
    {
        return $this->rutina;
    }

    public function setRutina(?Rutina $rutina): self
    {
        $this->rutina = $rutina;

        return $this;
    }


}
