<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReinaController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Reina:index.html.twig');
    }


}
