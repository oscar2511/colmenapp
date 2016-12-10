<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlertaController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Alerta:index.html.twig');
    }
/*
    public function detalleAction()
    {
        return $this->render('ColmenappPlataformaBundle:Apiario:detalle.html.twig');
    }*/

}
