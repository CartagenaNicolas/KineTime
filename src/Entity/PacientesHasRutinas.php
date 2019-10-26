<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PacientesHasRutinas
 *
 * @ORM\Table(name="pacientes_has_rutinas", indexes={@ORM\Index(name="fk_pacientes_has_rutinas_rutinas", columns={"rutina_id"}), @ORM\Index(name="fk_pacientes_has_rutinas_pacientes", columns={"paciente_id"})})
 * @ORM\Entity
 */
class PacientesHasRutinas
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
     * @var \Pacientes
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * @var \Rutinas
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

    public function getPaciente(): ?Paciente
    {
        return $this->paciente;
    }

    public function setPaciente(?Paciente $paciente): self
    {
        $this->paciente = $paciente;

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
