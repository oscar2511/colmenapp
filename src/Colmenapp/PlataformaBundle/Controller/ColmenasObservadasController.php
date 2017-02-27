<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ColmenasObservadasController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:ColmenasObservadas:index.html.twig');
    }


}
