<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Colmenapp\PlataformaBundle\Entity\ColmenaInspeccion;

class InspeccionColmenaService extends BaseInspeccionColmenaService
{

  public function crearInspeccion(
    $apiario,
    $fecha,
    $inspeccionApiario,
    $tareaRealizada,
    $observacion = null,
    array $colmenasSeleccionadas
    )
  {

    for($i=0; $i<count($colmenasSeleccionadas); $i++)
    {
      $colmena = $this->em
          ->getRepository('ColmenappPlataformaBundle:colmena')
          ->find((int)$colmenasSeleccionadas[$i]);

          var_dump($colmena);die;

      $colmenaInspeccion = new ColmenaInspeccion();

      $colmenaInspeccion->setFecha($fecha);
      $colmenaInspeccion->setColmena($colmena);
      $colmenaInspeccion->setInspeccionApiario($inspeccionApiario);
      $colmenaInspeccion->setTareaRealizada($tareaRealizada);
      $colmenaInspeccion->setObservacion($observacion);
      $colmenaInspeccion->setCreated(new \DateTime("now"));

      $this->em->persist($colmenaInspeccion);
    }

      $this->em->flush();

      return true;

  }


  /**
   * Retorna todos los apiarios
   */
  public function getInspecciones($idApiario)
  {
    $apiario = $this->em
        ->getRepository('ColmenappPlataformaBundle:Apiario')
        ->find($idApiario);

    $inspecciones = $this->em
        ->getRepository('ColmenappPlataformaBundle:Inspeccion')
        ->findBy(
            array('apiario' => $apiario),
            array('id' => 'DESC')
        );

    $inspeccionesArray = array();
    foreach ($inspecciones as $inspeccion) {
        array_push($inspeccionesArray, $inspeccion->toArray());
    }

    return $inspeccionesArray;
  }


}
