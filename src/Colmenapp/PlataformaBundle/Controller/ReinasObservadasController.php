<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReinasObservadasController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:ReinasObservadas:index.html.twig');
    }


}
