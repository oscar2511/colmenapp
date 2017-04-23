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

    /* reina */
    $dataReina = array(
      'reinaRazaId'        => $data['reinaRazaId'],
      'reinaIdentificador' => isset($data['reinaIdentificador']) ? $data['reinaIdentificador'] : uniqid()
     );

    if(isset($data['identificador']) && $data['identificador'])
      $identificador = $data['identificador'];
    else
      $identificador = uniqid();

    $tipo = $this->em
        ->getRepository('ColmenappPlataformaBundle:TipoColmena')
        ->find($tipoId);

    $apiario = $this->em
        ->getRepository('ColmenappPlataformaBundle:Apiario')
        ->find($apiarioId);

    if(isset($data['multiple']) && $data['multiple'] > 0)
      $this->crearMultiColmenas($apiario, $data['multiple'], $tipo, $rejilla, $camara, $dataReina );
    else {

      try {

        $this->em->getConnection()->beginTransaction();

        $colmena = new Colmena();

        $colmena->setIdentificador($identificador);
        $colmena->setApiario($apiario);
        $colmena->setTipo($tipo);
        $colmena->setRejillaExcluidora($rejilla);
        $colmena->setCamaraCria($camara);
        $colmena->setEnObservacion($enObservacion);
        $colmena->setEstado($estado);
        $colmena->setCreated(new \DateTime("now"));


        $reina = $this->reinaService->crearReina($dataReina, $colmena);

        $colmena->setReina($reina);

        $this->em->persist($colmena);

        $this->em->flush();

        $this->em->getConnection()->commit();

        return true;

      } catch (\Exception $e) {
          $this->em->getConnection()->rollback();
          return $e;
        }
    }
  }


  private function crearMultiColmenas(
    $apiario,
    $cantColmenas,
    $tipo,
    $rejilla,
    $camara,
    $dataReina)
  {

    for($i=0; $i<$cantColmenas; $i++) {
      $colmena = new Colmena();

      $colmena->setIdentificador(uniqid());
      $colmena->setApiario($apiario);
      $colmena->setTipo($tipo);
      $colmena->setRejillaExcluidora($rejilla);
      $colmena->setCamaraCria($camara);
      $colmena->setCreated(new \DateTime("now"));

      $dataReina['reinaIdentificador'] = null;
      $reina = $this->reinaService->crearReina($dataReina, $colmena);

      $colmena->setReina($reina);

      $this->em->persist($colmena);
      $this->em->flush();
    }
    return true;

  }


}
