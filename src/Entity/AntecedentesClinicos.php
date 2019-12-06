<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntecedentesClinicos
 *
 * @ORM\Table(name="antecedentes_clinicos", indexes={@ORM\Index(name="fk_antecedentes_clinicos_zona", columns={"zona_id"}), @ORM\Index(name="fk_antecedentes_clinicos_pacientes", columns={"paciente_id"})})
 * @ORM\Entity
 */
class AntecedentesClinicos
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
     * @ORM\Column(name="morbilidad", type="string", length=255, nullable=true)
     */
    private $morbilidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="medico", type="string", length=255, nullable=true)
     */
    private $medico;

    /**
     * @var string|null
     *
     * @ORM\Column(name="operacion", type="string", length=200, nullable=true)
     */
    private $operacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="factores_riesgo", type="string", length=200, nullable=true)
     */
    private $factoresRiesgo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cuando_episodio", type="string", nullable=true)
     */
    private $cuandoEpisodio;

    /**
     * @var \Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente_id", referencedColumnName="id")
     * })
     */
    private $paciente;

    /**
     * @var \ZonaLesion
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ZonaLesion", inversedBy="antecedenteClinico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zona_id", referencedColumnName="id")
     * })
     */
    private $zona;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMorbilidad(): ?string
    {
        return $this->morbilidad;
    }

    public function setMorbilidad(?string $morbilidad): self
    {
        $this->morbilidad = $morbilidad;

        return $this;
    }

    public function getMedico(): ?string
    {
        return $this->medico;
    }

    public function setMedico(?string $medico): self
    {
        $this->medico = $medico;

        return $this;
    }

    public function getOperacion(): ?string
    {
        return $this->operacion;
    }

    public function setOperacion(?string $operacion): self
    {
        $this->operacion = $operacion;

        return $this;
    }

    public function getFactoresRiesgo(): ?string
    {
        return $this->factoresRiesgo;
    }

    public function setFactoresRiesgo(?string $factoresRiesgo): self
    {
        $this->factoresRiesgo = $factoresRiesgo;

        return $this;
    }

    public function getCuandoEpisodio()
    {
        return $this->cuandoEpisodio;
    }

    public function setCuandoEpisodio($cuandoEpisodio): self
    {
        $this->cuandoEpisodio = $cuandoEpisodio;

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

    public function getZona(): ?ZonaLesion
    {
        return $this->zona;
    }

    public function setZona(?ZonaLesion $zona): self
    {
        $this->zona = $zona;

        return $this;
    }


}
