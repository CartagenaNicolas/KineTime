<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ZonaLesion
 *
 * @ORM\Table(name="zona_lesion")
 * @ORM\Entity
 */
class ZonaLesion
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AntecedentesClinicos", mappedBy="zona")
     */
    private $antecedenteClinico;

    public function __construct()
    {
        $this->antecedenteClinico = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|AntecedenteClinico[]
     */
    public function getAntecedenteClinico(): Collection
    {
        return $this->antecedenteClinico;
    }

    public function addAntecedenteClinico(AntecedentesClinicos $antecedenteClinico): self
    {
        if (!$this->antecedenteClinico->contains($antecedenteClinico)) {
            $this->antecedenteClinico[] = $antecedenteClinico;
            $antecedenteClinico->setZona($this);
        }

        return $this;
    }

    public function removeAntecedenteClinico(AntecedentesClinicos $antecedenteClinico): self
    {
        if ($this->antecedenteClinico->contains($antecedenteClinico)) {
            $this->antecedenteClinico->removeElement($antecedenteClinico);
            // set the owning side to null (unless already changed)
            if ($antecedenteClinico->getZona() === $this) {
                $antecedenteClinico->setZona(null);
            }
        }

        return $this;
    }


}
