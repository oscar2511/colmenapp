<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReinaController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Reina:index.html.twig');
    }

    /**
     * Retorna todos los apiarios
     */
    public function getRazasAction ()
    {
        try {
            $reinaService = $this->get('reina_service');

            $razas = $reinaService->getRazas();

            return new JsonResponse(array(
                'status' => 200,
                'data'   => $razas
            ));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e
            ));
          }
      }



}
