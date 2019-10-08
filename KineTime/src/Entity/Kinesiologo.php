<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Kinesiologos
 *
 * @ORM\Table(name="kinesiologos")
 * @ORM\Entity
 */
class Kinesiologo implements UserInterface
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
     * @ORM\Column(name="nombre", type="string", length=200, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=32, nullable=false, options={"fixed"=true})
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="especialidad", type="string", length=200, nullable=true)
     */
    private $especialidad;

    /**
     * @var int|null
     *
     * @ORM\Column(name="certificaciones", type="integer", nullable=true)
     */
    private $certificaciones;

    /**
     * @var int|null
     *
     * @ORM\Column(name="anos_experiencia", type="integer", nullable=true)
     */
    private $anosExperiencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="metas", type="string", length=1000, nullable=true)
     */
    private $metas;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=20, nullable=true)
     */
    private $role;

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEspecialidad(): ?string
    {
        return $this->especialidad;
    }

    public function setEspecialidad(?string $especialidad): self
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    public function getCertificaciones(): ?int
    {
        return $this->certificaciones;
    }

    public function setCertificaciones(?int $certificaciones): self
    {
        $this->certificaciones = $certificaciones;

        return $this;
    }

    public function getAnosExperiencia(): ?int
    {
        return $this->anosExperiencia;
    }

    public function setAnosExperiencia(?int $anosExperiencia): self
    {
        $this->anosExperiencia = $anosExperiencia;

        return $this;
    }

    public function getMetas(): ?string
    {
        return $this->metas;
    }

    public function setMetas(?string $metas): self
    {
        $this->metas = $metas;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getUsername() {
        return $this->rut;
    }

    public function getSalt() {
        return null;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

    public function eraseCredentials() {}
}
