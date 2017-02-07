<?php

namespace Colmenapp\PlataformaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $event = new Event(array('id'=>12345678));
        $dispatcher = $this->container->get('event_dispatcher');
        $dispatcher->dispatch('MI_TEST_SUBSCRIBER', $event);

        return $this->render('ColmenappPlataformaBundle:Dashboard:index.html.twig');
    }
}
