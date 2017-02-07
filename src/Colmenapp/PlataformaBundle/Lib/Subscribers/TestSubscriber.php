<?php

namespace Colmenapp\PlataformaBundle\Lib\Subscribers;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

Class TestSubscriber implements EventSubscriberInterface
{
    protected $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return array (
         'MI_TEST_SUBSCRIBER' => 'onTest' //todo: acá quede
        );
    }


    public function onTest(Event $event) {
        //var_dump($event->getName()); die;
    }

}