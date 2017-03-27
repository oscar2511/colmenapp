<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Colmenapp\PlataformaBundle\Entity\Apiario;
use Symfony\Component\HttpFoundation\JsonResponse;
use Assetic\Exception;

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
        $em    = $this->getDoctrine()->getManager();

        try {
            $apiario = new Apiario();

            $apiario->setNombre($data['nombre']);
            $apiario->setDireccion($data['direccion']);
            $apiario->setObservacion($data['observacion']);
            $apiario->setCreated(new \DateTime("now"));

            $em->persist($apiario);
            $em->flush();

            return new JsonResponse(array(
                'status' => 200,
                'data'   => $apiario->toArray()
            ));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e
            ));
        }
    }

    /**
     * Retorna todos los apiarios
     */
    public function getApiariosAction ()
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $apiarios = $em
                ->getRepository('ColmenappPlataformaBundle:Apiario')
                ->findBy([],array('id' => 'DESC')
              );

            $apiariosArray = array();
            foreach ($apiarios as $apiario) {
                array_push($apiariosArray, $apiario->toArray());
            }

            return new JsonResponse(array(
                'status' => 200,
                'data'   => $apiariosArray
            ));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e
            ));
        }

    }

}
