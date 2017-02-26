<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NucleoController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Nucleo:index.html.twig');
    }


}
