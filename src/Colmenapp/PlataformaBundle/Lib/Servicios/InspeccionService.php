<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Colmenapp\PlataformaBundle\Entity\Inspeccion;

class InspeccionService extends BaseInspeccionService
{

  public function crearInspeccion(array $data)
  {
    $apiarioId      = $data['apiarioId'];
    $fecha          = new \DateTime($data['fecha']);
    $tareaRealizada = $data['tareaRealizada'];
    $tareaEnColmena = isset($data['tareaEnColmena']) ? 1 : 0;
    $observacion    = isset($data['observacion']) ? $data['observacion'] : null;

    $apiario = $this->em
        ->getRepository('ColmenappPlataformaBundle:Apiario')
        ->find($apiarioId);

      $inspeccion = new Inspeccion();

      $inspeccion->setApiario($apiario);
      $inspeccion->setFecha($fecha);
      $inspeccion->setTareaRealizada($tareaRealizada);
      $inspeccion->setTareaEnColmena($tareaEnColmena);
      $inspeccion->setObservacion($observacion);
      $inspeccion->setCreated(new \DateTime("now"));

      $this->em->persist($inspeccion);
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
