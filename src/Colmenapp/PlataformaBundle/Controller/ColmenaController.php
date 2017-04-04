<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Colmenapp\PlataformaBundle\Entity\Colmena;

class ColmenaController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:Colmena:index.html.twig');
    }

    public function inspeccionNuevaAction()
    {
        return $this->render('ColmenappPlataformaBundle:Colmena:inspeccionNueva.html.twig');
    }

    public function inspeccionAction()
    {
        return $this->render('ColmenappPlataformaBundle:Colmena:colemenaInpeccion.html.twig');
    }

    public function detalleAction()
    {
        return $this->render('ColmenappPlataformaBundle:Colmena:detalle.html.twig');
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
        $identificador = isset($data['identificador']) ? $data['identificador'] : uniqid();
        $apiarioId     = isset($data['apiarioId']) ? $data['apiarioId'] : null;
        $tipoId        = isset($data['tipo']) ? $data['tipo'] : null;
        $rejilla       = isset($data['rejilla']) ? $data['rejilla'] : null;
        $camara        = isset($data['camaraCria']) ? $data['camaraCria'] : 1;
        $enObservacion = isset($data['enObservacion']) ? $data['enObservacion'] : null;
        $estado        = isset($data['estado']) ? $data['estado'] : null;

        $em   = $this->getDoctrine()->getManager();
        try {
            $tipo =  $em
                ->getRepository('ColmenappPlataformaBundle:TipoColmena')
                ->find($tipoId);

            $apiario = $em
                ->getRepository('ColmenappPlataformaBundle:Apiario')
                ->find($apiarioId);

            $colmena = new Colmena();

            $colmena->setIdentificador($identificador);
            $colmena->setApiario($apiario);
            $colmena->setTipo($tipo);
            $colmena->setRejillaExcluidora($rejilla);
            $colmena->setCamaraCria($camara);
            $colmena->setEnObservacion($enObservacion);
            $colmena->setEstado($estado);
            $colmena->setCreated(new \DateTime("now"));

            $em->persist($colmena);
            $em->flush();

            return new JsonResponse(array(
                'status' => 200,
                'data'   => $colmena->toArray()
            ));
        } catch (\Exception $e) {
            //var_dump($e); die;
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e->getMessage()
            ));
        }
    }

    /**
     * Retorna todas las colmenas de un apiario
     * @param Request $request
     * @return JsonResponse
     */
    public function getColmenasAction (Request $request)
    {
        try {
            $apiarioId = (int)$request->get('apiarioId');

            $em = $this->getDoctrine()->getManager();
            $apiario = $em
                ->getRepository('ColmenappPlataformaBundle:Apiario')
                ->find($apiarioId);
            $colmenas = $em
                ->getRepository('ColmenappPlataformaBundle:Colmena')
                ->findBy(
                    array('apiario' => $apiario),
                    array('id' => 'DESC')
                );

            $colmenasArray = array();
            foreach ($colmenas as $colmena) {
                array_push($colmenasArray, $colmena->toArray());
            }

            return new JsonResponse(array(
                'status' => 200,
                'data'   => $colmenasArray
            ));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e
            ));
        }
    }

    /**
     * Devuelve los tipos de colmenas
     * @return JsonResponse
     */
    public function getTiposColmenasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tiposColmenas = $em
            ->getRepository('ColmenappPlataformaBundle:TipoColmena')
            ->findAll();

        $tiposColmenasArray = array();
        foreach ($tiposColmenas as $tipoColmena) {
            array_push($tiposColmenasArray, $tipoColmena->toArray());
        }

        return new JsonResponse(array(
            'status' => 200,
            'data'   => $tiposColmenasArray
        ));
    }
}
