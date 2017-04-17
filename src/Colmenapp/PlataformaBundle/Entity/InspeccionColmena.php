<?php

namespace Colmenapp\PlataformaBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * InspeccionColmena
 *
 * @ORM\Table(name="inspeccion_colmena")
 * @ORM\Entity(repositoryClass="Colmenapp\PlataformaBundle\Repository\InspeccionColmenaRepository")
 */
class InspeccionColmena
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
     * @return InspeccionColmena
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
     * @return InspeccionColmena
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
     * @return InspeccionColmena
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
     * @return InspeccionColmena
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
     * @return InspeccionColmena
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
     * @return InspeccionColmena
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
     * @return InspeccionColmena
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
     * @return InspeccionColmena
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
