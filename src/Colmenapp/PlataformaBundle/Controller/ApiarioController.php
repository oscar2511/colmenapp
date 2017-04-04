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

    public function detalleAction(Request $request)
    {
        $idApiario    = $request->get('id');
        $climaService = $this->get('clima_service');
        $climaActual  = $climaService->getClimaActual();

        $em = $this->getDoctrine()->getManager();
        $apiario = $em
            ->getRepository('ColmenappPlataformaBundle:Apiario')
            ->find($idApiario);

        return $this->render('ColmenappPlataformaBundle:Apiario:detalle.html.twig', array(
            'clima'   => $climaActual,
            'apiario' => $apiario
        ));
    }

    public function crearAction(Request $request)
    {
        $info = $request->getContent();
        $data = json_decode($info,true);
        $em   = $this->getDoctrine()->getManager();
        $observacion = isset($data['observacion']) ? $data['observacion'] : null;
        $direccion   = isset($data['direccion']) ? $data['direccion'] : null;

        try {
            $apiario = new Apiario();

            $apiario->setNombre($data['nombre']);
            $apiario->setObservacion($observacion);
            $apiario->setDireccion($data['direccion']);
            $apiario->setCreated(new \DateTime("now"));

            $em->persist($apiario);
            $em->flush();

            return new JsonResponse(array(
                'status' => 200,
                'data'   => $apiario->toArray()
            ));
        } catch (\Exception $e) {
          var_dump($e); die;
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e->getMessage()
            ));
        }
    }

    /**
    *
    * @param Request $request
    */
    public function editarAction(Request $request)
    {
        $info  = $request->getContent();
        $data  = json_decode($info,true);
        $em    = $this->getDoctrine()->getManager();

        try {
            $apiario = $em
                ->getRepository('ColmenappPlataformaBundle:Apiario')
                ->find($data['id']);

            $apiario->setNombre($data['nombre']);
            $apiario->setDireccion($data['direccion']);
            $apiario->setObservacion($data['observacion']);
            $apiario->setUpdated(new \DateTime("now"));

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
