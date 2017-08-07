<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Colmenapp\PlataformaBundle\Entity\Reina;
use Colmenapp\PlataformaBundle\Entity\RazaReina;

class ReinaService extends BaseReinaService
{

  public function crearReina(array $data)
  {
    $colmena       = isset($data['colmena']);
    $identificador = isset($data['identificador']) ? $data['identificador'] : null;
    $razaId        = isset($data['razaId']) ? $data['razaId'] : null;
    $observada     = isset($data['observada']) ? $data['observada'] : 1;
    $enObservacion = isset($data['enObservacion']) ? $data['enObservacion'] : null;
    $estado        = isset($data['estado']) ? $data['estado'] : null;
    $fecha         = isset($data['fecha']);
    $estadoSalud   = isset($data['estadoSalud']) ? $data['estadoSalud'] : null;

    if(isset($data['identificador']) && $data['identificador'])
      $identificador = $data['identificador'];
    else
      $identificador = uniqid();

    $raza = $this->em
        ->getRepository('ColmenappPlataformaBundle:RazaReina')
        ->find($razaId);


    $reina = new Reina();

    $reina->setIdentificador($identificador);
    $reina->setColmena($colmena);
    $reina->setRaza($raza);
    $reina->setRejillaExcluidora($rejilla);
    $reina->setCamaraCria($camara);
    $reina->setEnObservacion($enObservacion);
    $reina->setEstado($estado);
    $reina->setCreated(new \DateTime("now"));

    $this->em->persist($reina);
    $this->em->flush();

    return true;

  }


}
