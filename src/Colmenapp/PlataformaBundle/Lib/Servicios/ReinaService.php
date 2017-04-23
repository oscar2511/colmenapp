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

public function crearReina(array $data, $colmena)
{

  if(isset($data['reinaIdentificador']) && $data['reinaIdentificador'])
    $identificador = $data['reinaIdentificador'];
  else
    $identificador = uniqid();

    $raza = $this->em
        ->getRepository('ColmenappPlataformaBundle:RazaReina')
        ->find($data['reinaRazaId']);

    $reina = new Reina();


    $reina->setIdentificador($identificador);
    $reina->setColmena($colmena);
    $reina->setRaza($raza);
    $reina->setFecha(new \DateTime("now"));
    $reina->setCreated(new \DateTime("now"));
    $this->em->persist($reina);
    
    return $reina;

}


  /**
  *
  *
  */
  public function getRazas()
  {
    $razas = $this->em
        ->getRepository('ColmenappPlataformaBundle:RazaReina')
        ->findAll();

    $razasArray = array();
    foreach ($razas as $raza) {
        array_push($razasArray, $raza->toArray());
    }

    return $razasArray;
  }


}
