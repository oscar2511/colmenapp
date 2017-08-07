<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class InspeccionController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Inspeccion:index.html.twig');
    }

    /**
    * Obtiene las inspecciones de un apiario
    *@param Request $request
    */
    public function getInspeccionesAction(Request $request)
    {
      try {
          $apiarioId = (int)$request->get('apiarioId');

          $inspeccionService = $this->get('inspeccion_service');

          $inspecciones = $inspeccionService->getInspecciones($apiarioId);

          return new JsonResponse(array(
              'status' => 200,
              'data'   => $inspecciones
          ));
      } catch (\Exception $e) {
          return new JsonResponse(array(
              'status' => 400,
              'data'   => $e
          ));
      }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function crearAction(Request $request)
    {
        $info = $request->getContent();
        $data = json_decode($info,true);
        $em   = $this->getDoctrine()->getManager();

        $inspeccionService = $this->get('inspeccion_service');

        try {
            $response = $inspeccionService->crearInspeccion($data);
            return new JsonResponse(array(
                'status' => 200,
                'data'   => "OK"
            ));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e->getMessage()
            ));
        }
    }


}
