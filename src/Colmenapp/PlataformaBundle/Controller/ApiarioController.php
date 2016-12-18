<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiarioController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Apiario:index.html.twig');
    }

    public function detalleAction()
    {
        $climaService = $this->get('clima_service');
        $climaActual = $climaService->getClimaActual();

        return $this->render('ColmenappPlataformaBundle:Apiario:detalle.html.twig', array(
            'clima' => $climaActual
        ));
    }

}
