<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TareasProgramadasController extends Controller
{
    public function indexAction()
    {
        return $this->render('ColmenappPlataformaBundle:TareaProgramada:index.html.twig');
    }


}
