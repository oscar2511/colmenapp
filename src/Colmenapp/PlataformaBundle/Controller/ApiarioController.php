<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Colmenapp\PlataformaBundle\Entity\Apiario;
use Symfony\Component\Validator\Constraints\Date;

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

    public function crearAction(Request $request)
    {
        $info  = $request->getContent();
        $data  = json_decode($info,true);
        $em = $this->getDoctrine()->getManager();

        $apiario = new Apiario();

        $apiario->setNombre($data['nombre']);
        $apiario->setDireccion($data['direccion']);
        $apiario->setObservacion($data['observacion']);
        $apiario->setCreated(new \DateTime("now") );

        $em->persist($apiario);
        $em->flush();




        var_dump($data); die;
    }

}
