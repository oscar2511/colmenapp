<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseReinaService
{

    /**
     * @param EntityManager $em
     */
    function __construct(
        EntityManager $em)
    {
        $this->em = $em;
    }

}
