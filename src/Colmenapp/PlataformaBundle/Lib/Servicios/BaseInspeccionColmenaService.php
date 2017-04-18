<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseInspeccionColmenaService
{

protected $em;
protected $colmenaService;
protected $inspeccionColmenaService;

    /**
     * @param EntityManager $em
     * @param colmenaService $colmenaService
     */
    function __construct(
      EntityManager $em,
      ColmenaService $colmenaService)
    {
        $this->em = $em;
        $this->colmenaService = $colmenaService;
    }

}
