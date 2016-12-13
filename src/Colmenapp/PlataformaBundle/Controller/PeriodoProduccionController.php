<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PeriodoProduccionController extends Controller
{
    public function indexAction()
    {

        return $this->render('ColmenappPlataformaBundle:PeriodoProduccion:index.html.twig');
    }
}
