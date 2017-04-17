<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Colmenapp\PlataformaBundle\Entity\Inspeccion;

class InspeccionColmenaService extends BaseInspeccionColmenaService
{

  public function crearInspeccion(array $data)
  {
    $apiarioId      = $data['apiarioId'];
    $fecha          = new \DateTime($data['fecha']);
    $tareaRealizada = $data['tareaRealizada'];
    $tareaEnColmena = isset($data['tareaEnColmena']) ? 1 : 0;
    $observacion    = isset($data['observacion']) ? $data['observacion'] : null;
    $colmenasSeleccionadas = isset($data['colmenasSeleccionadas']) ? $data['colmenasSeleccionadas'] : null;


    $apiario = $this->em
        ->getRepository('ColmenappPlataformaBundle:Apiario')
        ->find($apiarioId);
    try {
      if($colmenasSeleccionadas)

      $this->em->getConnection()->beginTransaction();

      $inspeccion = new Inspeccion();

      $inspeccion->setApiario($apiario);
      $inspeccion->setFecha($fecha);
      $inspeccion->setTareaRealizada($tareaRealizada);
      $inspeccion->setTareaEnColmena($tareaEnColmena);
      $inspeccion->setObservacion($observacion);
      $inspeccion->setCreated(new \DateTime("now"));

      $this->em->persist($inspeccion);
      $this->em->flush();

      $this->em->getConnection()->commit();

      return true;

    } catch (\Exception $e) {
        $this->em->getConnection()->rollback();
        return $e;
      }

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
