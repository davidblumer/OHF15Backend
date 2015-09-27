<?php
/**
 *
 * Copyright (c) 2015 Socialbit GmbH. All rights reserved.
 *
 */

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class CorsListener
 * @package AppBundle\EventListener
 * @author Fabian Sabau <fabian.sabau@socialbit.de>
 */
class CorsListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(KernelEvents::RESPONSE => 'onKernelResponse');
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $responseHeaders = $response->headers;

        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $responseHeaders->set('Access-Control-Allow-Origin', '*');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');

        $event->setResponse($response);
    }
}
