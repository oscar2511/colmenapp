<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ColmenaController extends Controller
{
    public function indexAction()
    {

        return $this->render('ColmenappPlataformaBundle:Colmena:index.html.twig');
    }

    public function inspeccionNuevaAction()
    {

        return $this->render('ColmenappPlataformaBundle:Colmena:inspeccionNueva.html.twig');
    }

    public function inspeccionAction()
    {

        return $this->render('ColmenappPlataformaBundle:Colmena:inspeccion.html.twig');
    }
}
