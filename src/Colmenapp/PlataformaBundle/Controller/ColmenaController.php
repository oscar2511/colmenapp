<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ColmenaController extends Controller
{
    public function indexAction()
    {

        return $this->render('ColmenappPlataformaBundle:Colmena:index.html.twig');
    }
}
