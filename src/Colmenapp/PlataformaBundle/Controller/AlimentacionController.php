<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlimentacionController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Alimentacion:index.html.twig');
    }


}
