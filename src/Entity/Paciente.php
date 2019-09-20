<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pacientes
 *
 * @ORM\Table(name="pacientes", indexes={@ORM\Index(name="fk_paciente_zona", columns={"zona_id"})})
 * @ORM\Entity
 */
class Paciente
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
     * @var string
     *
     * @ORM\Column(name="rut", type="string", length=12, nullable=false, options={"fixed"=true})
     */
    private $rut;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="edad", type="integer", nullable=false)
     */
    private $edad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="direccion", type="string", length=200, nullable=true)
     */
    private $direccion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cuando_episodio", type="string", length=200, nullable=true)
     */
    private $cuandoEpisodio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="operacion", type="string", length=200, nullable=true)
     */
    private $operacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farmacos", type="string", length=200, nullable=true)
     */
    private $farmacos;

    /**
     * @var string|null
     *
     * @ORM\Column(name="factores_riesgo", type="string", length=200, nullable=true)
     */
    private $factoresRiesgo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fumador", type="string", length=2, nullable=true, options={"fixed"=true})
     */
    private $fumador;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bebedor", type="string", length=2, nullable=true, options={"fixed"=true})
     */
    private $bebedor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="trabajo", type="string", length=200, nullable=true)
     */
    private $trabajo;

    /**
     * @var \ZonaLesion
     *
     * @ORM\ManyToOne(targetEntity="ZonaLesion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zona_id", referencedColumnName="id")
     * })
     */
    private $zona;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCuandoEpisodio(): ?string
    {
        return $this->cuandoEpisodio;
    }

    public function setCuandoEpisodio(?string $cuandoEpisodio): self
    {
        $this->cuandoEpisodio = $cuandoEpisodio;

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

    public function getFarmacos(): ?string
    {
        return $this->farmacos;
    }

    public function setFarmacos(?string $farmacos): self
    {
        $this->farmacos = $farmacos;

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

    public function getFumador(): ?string
    {
        return $this->fumador;
    }

    public function setFumador(?string $fumador): self
    {
        $this->fumador = $fumador;

        return $this;
    }

    public function getBebedor(): ?string
    {
        return $this->bebedor;
    }

    public function setBebedor(?string $bebedor): self
    {
        $this->bebedor = $bebedor;

        return $this;
    }

    public function getTrabajo(): ?string
    {
        return $this->trabajo;
    }

    public function setTrabajo(?string $trabajo): self
    {
        $this->trabajo = $trabajo;

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
