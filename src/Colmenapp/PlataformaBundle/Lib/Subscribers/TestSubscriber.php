<?php

namespace Colmenapp\PlataformaBundle\Lib\Subscribers;

Class TestSubscriber implemement EventSubscriberInterface
{
    protected $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
      /*  return array (
            KernelBundleEvents::MI_TEST_SUBSCRIBER => 'on' //todo: acá quede
        )*/
    }


}