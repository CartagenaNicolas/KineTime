<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PacienteHasKinesiologo
 *
 * @ORM\Table(name="paciente_has_kinesiologo", uniqueConstraints={@ORM\UniqueConstraint(name="kinesiologo_id", columns={"kinesiologo_id"}), @ORM\UniqueConstraint(name="paciente_id", columns={"paciente_id"})})
 * @ORM\Entity
 */
class PacienteHasKinesiologo
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
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comentario", type="string", length=1000, nullable=false)
     */
    private $comentario;

    /**
     * @var \Kinesiologos
     *
     * @ORM\ManyToOne(targetEntity="Kinesiologo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kinesiologo_id", referencedColumnName="id")
     * })
     */
    private $kinesiologo;

    /**
     * @var \Pacientes
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getKinesiologo(): ?Kinesiologo
    {
        return $this->kinesiologo;
    }

    public function setKinesiologo(?Kinesiologo $kinesiologo): self
    {
        $this->kinesiologo = $kinesiologo;

        return $this;
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


}
