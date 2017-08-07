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
        /*$redis = $this->container->get('snc_redis.default');
        $a = array('test' =>1);
        $expireMonth = 60 * 60 * 24 * 30;
        //$redis->set('testReedis', serialize($a));
        $redis->expire('testReedis', $expireMonth);
        var_dump(unserialize($redis->get('testReedis'))); die;
        */


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

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detalleAction(Request $request)
    {
        $idColmena    = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $colmena = $em
            ->getRepository('ColmenappPlataformaBundle:Colmena')
            ->find($idColmena);

        return $this->render('ColmenappPlataformaBundle:Colmena:detalle.html.twig', array(
            'colmena' => $colmena
        ));
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

        $colmenaService = $this->get('colmena_service');

        try {
            $response = $colmenaService->crearColmena($data);
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function editarAction(Request $request)
    {
        $info  = $request->getContent();
        $data  = json_decode($info,true);
        $em    = $this->getDoctrine()->getManager();

        $id            = $data['id'];
        $identificador = $data['identificador'];
        $apiarioId     = (int) $data['idApiario'] ;
        $tipoId        = $data['tipo'] ;
        $rejilla       = $data['rejilla'] ;
        $camara        = $data['camara'] ;
        $enObservacion = $data['enObservacion'] ;
        $estado        = $data['estado'] ;

        try {
            if($tipoId)
                $tipo =  $em
                    ->getRepository('ColmenappPlataformaBundle:TipoColmena')
                    ->find($data['tipo']['id']);

            $apiario = $em
                ->getRepository('ColmenappPlataformaBundle:Apiario')
                ->find($apiarioId);

            $colmena = $em
                ->getRepository('ColmenappPlataformaBundle:Colmena')
                ->find($id);

            if($identificador)$colmena->setIdentificador($identificador);
            if($apiario)$colmena->setApiario($apiario);
            if($tipoId) $colmena->setTipo($tipo);
            $colmena->setRejillaExcluidora($rejilla);
            if($camara)$colmena->setCamaraCria($camara);
            if($enObservacion)$colmena->setEnObservacion($enObservacion);
            if($estado)$colmena->setEstado($estado);
            $colmena->setUpdated(new \DateTime("now"));

            $em->persist($colmena);
            $em->flush();

            return new JsonResponse(array(
                'status' => 200,
                'data'   => $colmena->toArray()
            ));
        } catch (\Exception $e) {
            return new JsonResponse(array(
                'status' => 400,
                'data'   => $e
            ));
        }
    }
}
