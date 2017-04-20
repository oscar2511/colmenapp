<?php

namespace Colmenapp\PlataformaBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Colmenapp\PlataformaBundle\Entity\Colmena;


/**
 * Reina
 *
 * @ORM\Table(name="reina")
 * @ORM\Entity(repositoryClass="Colmenapp\PlataformaBundle\Repository\ReinaRepository")
 */
class Reina
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
     * @var string
     *
     * @ORM\Column(name="identificador", type="string", length=255)
     */
    private $identificador;

    /**
    *
    * @ORM\OneToOne(targetEntity="Colmena", mappedBy="reina")
    */
    private $colmena;

    /**
     * @var string
     *
     * @ORM\Column(name="raza", type="string", length=255, nullable=true)
     */
    private $raza;

    /**
     * @var bool
     *
     * @ORM\Column(name="observada", type="boolean", nullable=true)
     */
    private $observada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="estadoSalud", type="string", length=255, nullable=true)
     */
    private $estadoSalud;

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
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean", nullable=true)
     */
    private $estado;


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
     * Set identificador
     *
     * @param string $identificador
     * @return Reina
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;

        return $this;
    }

    /**
     * Get identificador
     *
     * @return string
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * Set colmena
     *
     * @param integer $colmena
     * @return Reina
     */
    public function setColmena($colmena)
    {
        $this->colmena = $colmena;

        return $this;
    }

    /**
     * Get colmena
     *
     * @return integer
     */
    public function getColmena()
    {
        return $this->colmena;
    }

    /**
     * Set raza
     *
     * @param string $raza
     * @return Reina
     */
    public function setRaza($raza)
    {
        $this->raza = $raza;

        return $this;
    }

    /**
     * Get raza
     *
     * @return string
     */
    public function getRaza()
    {
        return $this->raza;
    }

    /**
     * Set observada
     *
     * @param boolean $observada
     * @return Reina
     */
    public function setObservada($observada)
    {
        $this->observada = $observada;

        return $this;
    }

    /**
     * Get observada
     *
     * @return boolean
     */
    public function getObservada()
    {
        return $this->observada;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Reina
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
     * Set estadoSalud
     *
     * @param string $estadoSalud
     * @return Reina
     */
    public function setEstadoSalud($estadoSalud)
    {
        $this->estadoSalud = $estadoSalud;

        return $this;
    }

    /**
     * Get estadoSalud
     *
     * @return string
     */
    public function getEstadoSalud()
    {
        return $this->estadoSalud;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Reina
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
     * @return Reina
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
     * @return Reina
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
     * Set observacion
     *
     * @param string $observacion
     * @return Reina
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
     * @param boolean $estado
     * @return Reina
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
