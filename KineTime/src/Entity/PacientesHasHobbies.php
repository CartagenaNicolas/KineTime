<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PacientesHasHobbies
 *
 * @ORM\Table(name="pacientes_has_hobbies", indexes={@ORM\Index(name="fk_pacientes_has_hobbies_hobbies", columns={"hobbie_id"}), @ORM\Index(name="fk_pacientes_has_hobbies_pacientes", columns={"paciente_id"})})
 * @ORM\Entity
 */
class PacientesHasHobbies
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
     * @var \Hobbies
     *
     * @ORM\ManyToOne(targetEntity="Hobbies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hobbie_id", referencedColumnName="id")
     * })
     */
    private $hobbie;

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

    public function getHobbie(): ?Hobbies
    {
        return $this->hobbie;
    }

    public function setHobbie(?Hobbies $hobbie): self
    {
        $this->hobbie = $hobbie;

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
