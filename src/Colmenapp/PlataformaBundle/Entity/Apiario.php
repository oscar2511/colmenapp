<?php

namespace Colmenapp\PlataformaBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Leadsius\PlatformBundle\Entity\PlAccount
 *
 * @ORM\Table(name="apiario")
 * @ORM\Entity(repositoryClass="Colmenapp\PlataformaBundle\Repository\ApiarioRepository")
 */
class Apiario
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    protected $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    protected $direccion;

    /**
     * @var text    $updated
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    protected $observacion;

    /**
     * @var \DateTime    $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * @var \DateTime    $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    /**
     * @var \Datetime $deleted
     *
     * @ORM\Column(name="deleted", type="datetime", nullable=true)
     */
    protected $deleted;

    public function __toString()
    {
        return $this->nombre;
    }

    public function __construct()
    {
        /*$this->idApp = new ArrayCollection();
        $this->idUser = new ArrayCollection();
        $this->idCompany = new ArrayCollection();
        $this->idContact = new ArrayCollection();
        $this->idRol = new ArrayCollection();
        $this->systemKey = sha1(rand());
        $this->showTrackerCode = true;
        $this->accountIsLocked = false;
        $this->superAccountAdministration = false;
        $this->accountRootValidation = 0;
        $this->apiKeys = new ArrayCollection();
        */
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return text
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * @param text $observacion
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    }



    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return \Datetime
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param \Datetime $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array (
            'id'          => $this->id,
            'nombre'      => $this->nombre,
            'direccion'   => $this->direccion ? $this->direccion : null,
            'observacion' => $this->observacion ? $this->observacion : null,
            'created'     => $this->created
        );
    }


}
