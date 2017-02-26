<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TratamientoController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Tratamiento:index.html.twig');
    }


}
