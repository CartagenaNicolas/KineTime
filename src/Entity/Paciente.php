<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Paciente
 *
 * @ORM\Table(name="pacientes")
 * @ORM\Entity
 */
class Paciente implements UserInterface
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
     * @ORM\Column(name="correo", type="string", length=255, nullable=false)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=60, nullable=false)
     */
    private $password;

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

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getEstado(): ?bool
    {
        return $this->estado;
    }

    public function setEstado(bool $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getUsername() {
        return $this->correo;
    }

    public function getSalt() {
        return null;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function eraseCredentials() {}
}
