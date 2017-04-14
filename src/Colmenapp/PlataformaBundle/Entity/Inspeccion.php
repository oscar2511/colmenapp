<?php

namespace Colmenapp\PlataformaBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Inspeccion
 *
 * @ORM\Table(name="inspeccion")
 * @ORM\Entity(repositoryClass="Colmenapp\PlataformaBundle\Repository\InspeccionRepository")
 */
class Inspeccion
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
     * @ORM\ManyToOne(targetEntity="Apiario")
     * @assert\NotBlank()
     */
    private $apiario;

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
     * @var bool
     *
     * @ORM\Column(name="tareaEnColmena", type="boolean", nullable=true)
     */
    private $tareaEnColmena;

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
     * @return Inspeccion
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
        return $this->fecha->format('d-m-Y');
    }

    /**
     * Set apiario
     *
     * @param Apiario $apiario
     * @return Inspeccion
     */
    public function setApiario($apiario)
    {
        $this->apiario = $apiario;

        return $this;
    }

    /**
     * Get apiario
     *
     * @return integer
     */
    public function getApiario()
    {
        return $this->apiario;
    }

    /**
     * Set tareaRealizada
     *
     * @param string $tareaRealizada
     * @return Inspeccion
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
     * @return Inspeccion
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
     * Set tareaEnColmena
     *
     * @param boolean $tareaEnColmena
     * @return Inspeccion
     */
    public function setTareaEnColmena($tareaEnColmena)
    {
        $this->tareaEnColmena = $tareaEnColmena;

        return $this;
    }

    /**
     * Get tareaEnColmena
     *
     * @return boolean
     */
    public function getTareaEnColmena()
    {
        return $this->tareaEnColmena;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Inspeccion
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
        return $this->created->format('d-m-Y');
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Inspeccion
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
     * @return Inspeccion
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

    /**
     * @return array
     */
    public function toArray()
    {
        return array (
            'id'             => $this->id,
            'fecha'          => $this->getFecha(),
            'apiario'        => $this->apiario->toArray(),
            'tareaRealizada' => $this->tareaRealizada,
            'observacion'    => $this->observacion,
            'tareaEnColmena' => $this->tareaEnColmena,
            'deleted'        => $this->deleted,
            'created'        => $this->getCreated()
        );
    }


}
