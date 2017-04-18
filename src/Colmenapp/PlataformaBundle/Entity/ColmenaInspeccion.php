<?php

namespace Colmenapp\PlataformaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColmenaInspeccion
 *
 * @ORM\Table(name="colmena_inspeccion")
 * @ORM\Entity(repositoryClass="Colmenapp\PlataformaBundle\Repository\ColmenaInspeccionRepository")
 */
class ColmenaInspeccion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Colmena")
     */
    private $colmena;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @ORM\OneToOne(targetEntity="Inspeccion")
     */
    private $inspeccionApiario;

    /**
     * @var string
     *
     * @ORM\Column(name="tareaRealizada", type="text")
     */
    private $tareaRealizada;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var int
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    private $deleted;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ColmenaInspeccion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set inspeccionApiario
     *
     * @param integer $inspeccionApiario
     * @return ColmenaInspeccion
     */
    public function setInspeccionApiario($inspeccionApiario)
    {
        $this->inspeccionApiario = $inspeccionApiario;

        return $this;
    }

    /**
     * Get inspeccionApiario
     *
     * @return integer
     */
    public function getInspeccionApiario()
    {
        return $this->inspeccionApiario;
    }

    /**
     * Set tareaRealizada
     *
     * @param string $tareaRealizada
     * @return ColmenaInspeccion
     */
    public function setTareaRealizada($tareaRealizada)
    {
        $this->tareaRealizada = $tareaRealizada;

        return $this;
    }

    /**
     * Get tareaRealizada
     *
     * @return string
     */
    public function getTareaRealizada()
    {
        return $this->tareaRealizada;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return ColmenaInspeccion
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return ColmenaInspeccion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ColmenaInspeccion
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return ColmenaInspeccion
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set deleted
     *
     * @param \DateTime $deleted
     * @return ColmenaInspeccion
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return \DateTime
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
