<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeportesHasPacientes
 *
 * @ORM\Table(name="deportes_has_pacientes", indexes={@ORM\Index(name="fk_deportes_has_pacientes_pacientes", columns={"paciente_id"}), @ORM\Index(name="fk_deportes_has_pacientes_deportes", columns={"deporte_id"})})
 * @ORM\Entity
 */
class DeportesHasPacientes
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
     * @var \Deportes
     *
     * @ORM\ManyToOne(targetEntity="Deportes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="deporte_id", referencedColumnName="id")
     * })
     */
    private $deporte;

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

    public function getDeporte(): ?Deportes
    {
        return $this->deporte;
    }

    public function setDeporte(?Deportes $deporte): self
    {
        $this->deporte = $deporte;

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
