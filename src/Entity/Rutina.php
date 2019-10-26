<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rutina
 *
 * @ORM\Table(name="rutinas", indexes={@ORM\Index(name="fk_rutinas_volumenes", columns={"volumen"})})
 * @ORM\Entity
 */
class Rutina
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
     * @var string|null
     *
     * @ORM\Column(name="tiempo", type="time", nullable=true)
     */
    private $tiempo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descanso", type="time", nullable=true)
     */
    private $descanso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=true)
     */
    private $horaInicio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hora_termino", type="time", nullable=true)
     */
    private $horaTermino;

    /**
     * @var \Volumen
     *
     * @ORM\ManyToOne(targetEntity="Volumen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="volumen", referencedColumnName="id")
     * })
     */
    private $volumen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTiempo()
    {
        return $this->tiempo;
    }

    public function setTiempo($tiempo): self
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    public function getDescanso(): ?\DateTimeInterface
    {
        return $this->descanso;
    }

    public function setDescanso(?\DateTimeInterface $descanso): self
    {
        $this->descanso = $descanso;

        return $this;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(?\DateTimeInterface $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    public function getHoraTermino(): ?\DateTimeInterface
    {
        return $this->horaTermino;
    }

    public function setHoraTermino(?\DateTimeInterface $horaTermino): self
    {
        $this->horaTermino = $horaTermino;

        return $this;
    }

    public function getVolumen(): ?Volumen
    {
        return $this->volumen;
    }

    public function setVolumen(?Volumen $volumen): self
    {
        $this->volumen = $volumen;

        return $this;
    }


}
