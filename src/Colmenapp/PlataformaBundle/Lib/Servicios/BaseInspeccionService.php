<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseInspeccionService
{

    protected $em;
    protected $inspeccionColmenaService;
    /**
     * @param EntityManager $em
     */
    function __construct(
      EntityManager $em,
      InspeccionColmenaService $inspeccionColmenaService)
    {
        $this->inspeccionColmenaService = $inspeccionColmenaService;
        $this->em = $em;
    }

}
