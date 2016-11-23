<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {

        return $this->render('ColmenappPlataformaBundle:Dashboard:index.html.twig');
    }
}
