<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Colmenapp\PlataformaBundle\Entity\Colmena;

class ColmenaService extends BaseColmenaService
{

  public function crearColmena(array $data)
  {
    $apiarioId     = isset($data['apiarioId']) ? $data['apiarioId'] : null;
    $tipoId        = isset($data['tipo']) ? $data['tipo'] : null;
    $rejilla       = isset($data['rejilla']) ? $data['rejilla'] : null;
    $camara        = isset($data['camaraCria']) ? $data['camaraCria'] : 1;
    $enObservacion = isset($data['enObservacion']) ? $data['enObservacion'] : null;
    $estado        = isset($data['estado']) ? $data['estado'] : null;

    if(isset($data['identificador']) && $data['identificador'])
      $identificador = $data['identificador'];
    else
      $identificador = uniqid();

    $tipo =  $this->em
        ->getRepository('ColmenappPlataformaBundle:TipoColmena')
        ->find($tipoId);

    $apiario = $this->em
        ->getRepository('ColmenappPlataformaBundle:Apiario')
        ->find($apiarioId);

    if(isset($data['multiple']) && $data['multiple'] > 0)
      $this->crearMultiColmenas($apiario, $data['multiple'], $tipo, $rejilla, $camara );
    else {

      $colmena = new Colmena();

      $colmena->setIdentificador($identificador);
      $colmena->setApiario($apiario);
      $colmena->setTipo($tipo);
      $colmena->setRejillaExcluidora($rejilla);
      $colmena->setCamaraCria($camara);
      $colmena->setEnObservacion($enObservacion);
      $colmena->setEstado($estado);
      $colmena->setCreated(new \DateTime("now"));

      $this->em->persist($colmena);
      $this->em->flush();

      return true;
    }
  }


  private function crearMultiColmenas($apiario, $cantColmenas, $tipo, $rejilla, $camara)
  {
    for($i=0; $i<$cantColmenas; $i++) {
      $colmena = new Colmena();

      $colmena->setIdentificador(uniqid());
      $colmena->setApiario($apiario);
      $colmena->setTipo($tipo);
      $colmena->setRejillaExcluidora($rejilla);
      $colmena->setCamaraCria($camara);
      $colmena->setCreated(new \DateTime("now"));

      $this->em->persist($colmena);
      $this->em->flush();
    }
    return true;

  }


}
