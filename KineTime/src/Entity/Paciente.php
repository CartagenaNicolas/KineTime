<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pacientes
 *
 * @ORM\Table(name="pacientes")
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
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var int|null
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
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
     * @ORM\Column(name="ocupacion", type="string", length=200, nullable=true)
     */
    private $ocupacion;

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

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): self
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

    public function getOcupacion(): ?string
    {
        return $this->ocupacion;
    }

    public function setOcupacion(?string $ocupacion): self
    {
        $this->ocupacion = $ocupacion;

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


}
