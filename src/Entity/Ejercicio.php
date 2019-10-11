<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ejercicio
 *
 * @ORM\Table(name="ejercicios", indexes={@ORM\Index(name="fk_ejercicios_tipo_ejercicios", columns={"tipo_ejercicio"})})
 * @ORM\Entity
 */
class Ejercicio
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="objetivo", type="string", length=50, nullable=true)
     */
    private $objetivo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=100, nullable=true)
     */
    private $url;

    /**
     * @var \TipoEjercicio
     *
     * @ORM\ManyToOne(targetEntity="TipoEjercicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_ejercicio", referencedColumnName="id")
     * })
     */
    private $tipoEjercicio;

    /**
     * @Assert\File(
     *     mimeTypes={"video/mp4", "video/mpeg4-generic"},
     *     mimeTypesMessage="Por Favor subir un video en formato mp4 0 mpeg4"
     * )
     */
    protected $video;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getObjetivo(): ?string
    {
        return $this->objetivo;
    }

    public function setObjetivo(?string $objetivo): self
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTipoEjercicio(): ?TipoEjercicio
    {
        return $this->tipoEjercicio;
    }

    public function setTipoEjercicio(?TipoEjercicio $tipoEjercicio): self
    {
        $this->tipoEjercicio = $tipoEjercicio;

        return $this;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }


}
