<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PacientesHasExamenes
 *
 * @ORM\Table(name="pacientes_has_examenes", indexes={@ORM\Index(name="fk_pacientes_has_examenes_examenes", columns={"examen_id"}), @ORM\Index(name="fk_pacientes_has_examenes_pacientes", columns={"paciente_id"})})
 * @ORM\Entity
 */
class PacientesHasExamenes
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
     * @var \Examenes
     *
     * @ORM\ManyToOne(targetEntity="Examenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="examen_id", referencedColumnName="id")
     * })
     */
    private $examen;

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

    public function getExamen(): ?Examenes
    {
        return $this->examen;
    }

    public function setExamen(?Examenes $examen): self
    {
        $this->examen = $examen;

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
