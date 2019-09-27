<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PacientesHasEnfermedades
 *
 * @ORM\Table(name="pacientes_has_enfermedades", indexes={@ORM\Index(name="fk_pacientes_has_enfermedades_enfermedades", columns={"enfermedad_id"}), @ORM\Index(name="fk_pacientes_has_enfermedades_pacientes", columns={"paciente_id"})})
 * @ORM\Entity
 */
class PacientesHasEnfermedades
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
     * @var \Enfermedades
     *
     * @ORM\ManyToOne(targetEntity="Enfermedades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="enfermedad_id", referencedColumnName="id")
     * })
     */
    private $enfermedad;

    /**
     * @var \Pacientes
     *
     * @ORM\ManyToOne(targetEntity="Pacientes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnfermedad(): ?Enfermedades
    {
        return $this->enfermedad;
    }

    public function setEnfermedad(?Enfermedades $enfermedad): self
    {
        $this->enfermedad = $enfermedad;

        return $this;
    }

    public function getPaciente(): ?Pacientes
    {
        return $this->paciente;
    }

    public function setPaciente(?Pacientes $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }


}
