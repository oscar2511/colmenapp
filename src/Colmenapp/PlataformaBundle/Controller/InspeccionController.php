<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InspeccionController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Inspeccion:index.html.twig');
    }


}
