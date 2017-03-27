<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduccionController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Produccion:index.html.twig');
    }


}
