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
 * @ORM\Table(name="colmena")
 * @ORM\Entity(repositoryClass="Colmenapp\PlataformaBundle\Repository\ColmenaRepository")
 */
class Colmena
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
     * @ORM\Column(name="identificador", type="string", length=255)
     */
    protected $identificador;

    /**
     * @ORM\ManyToOne(targetEntity="Apiario")
     * @assert\NotBlank()
     */
    protected $apiario;

    /**
     * @ORM\ManyToOne(targetEntity="TipoColmena")
     * @assert\NotBlank()
     */
    protected $tipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rejilla_excluidora", type="boolean", nullable=true)
     */
    protected $rejillaExcluidora;

    /**
     * @var int
     *
     * @ORM\Column(name="camara_cria", type="integer", nullable=true)
     */
    protected $camaraCria;

    /**
     * @var boolean
     *
     * @ORM\Column(name="en_observacion", type="boolean", nullable=true)
     */
    protected $enObservacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ultima_visita", type="datetime", nullable=true)
     */
    protected $ultimaVisita;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="text", nullable=true)
     */
    protected $estado;

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
        return $this->identificador;
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
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * @param string $identificador
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;
    }

    /**
     * @return string
     */
    public function getApiario()
    {
        return $this->apiario;
    }

    /**
     * @param Apiario $apiario
     */
    public function setApiario(Apiario $apiario)
    {
        $this->apiario = $apiario;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return boolean
     */
    public function isRejillaExcluidora()
    {
        return $this->rejillaExcluidora;
    }

    /**
     * @param boolean $rejillaExcluidora
     */
    public function setRejillaExcluidora($rejillaExcluidora)
    {
        $this->rejillaExcluidora = $rejillaExcluidora;
    }

    /**
     * @return int
     */
    public function getCamaraCria()
    {
        return $this->camaraCria;
    }

    /**
     * @param int $camaraCria
     */
    public function setCamaraCria($camaraCria)
    {
        $this->camaraCria = $camaraCria;
    }

    /**
     * @return boolean
     */
    public function isEnObservacion()
    {
        return $this->enObservacion;
    }

    /**
     * @param boolean $enObservacion
     */
    public function setEnObservacion($enObservacion)
    {
        $this->enObservacion = $enObservacion;
    }

    /**
     * @return boolean
     */
    public function isUltimaVisita()
    {
        return $this->ultimaVisita;
    }

    /**
     * @param boolean $ultimaVisita
     */
    public function setUltimaVisita($ultimaVisita)
    {
        $this->ultimaVisita = $ultimaVisita;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created->format('d-m-Y');
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
            'id'                => $this->id,
            'identificador'     => $this->identificador,
            'apiario'           => $this->apiario->toArray(),
            'tipo'              => $this->tipo->toArray(),
            'rejillaExcluidora' => $this->rejillaExcluidora,
            'camaraCria'        => $this->camaraCria,
            'enObservacion'     => $this->enObservacion,
            'ultimaVisita'      => $this->ultimaVisita,
            'estado'            => $this->estado,
            'created'           => $this->getCreated()
        );
    }


}
