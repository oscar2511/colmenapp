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

    public function getInspeccionesAction(Request $request)
    {
      try {
          $apiarioId = (int)$request->get('apiarioId');

          $inspeccionService = $this->get('inspeccion_service');

          $inspecciones = $InspeccionService->getInspecciones($apiarioId);

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


}
