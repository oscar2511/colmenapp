<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseColmenaService
{

    /**
     * @param EntityManager $em
     * @param $doctrineService
     */
    function __construct(
        EntityManager $em,
        $doctrineService)
    {
        $this->em        = $em;
        $this->doctrineService = $doctrineService;
    }

}
