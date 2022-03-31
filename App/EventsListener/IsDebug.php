<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Controller\Debug;
use App\Infra\EventsDispatcher\Events\ControllerEvent;
use App\Infra\EventsDispatcher\ListenerInterface;

class IsDebug implements ListenerInterface
{
    public function support($event): bool
    {
        return $event instanceof ControllerEvent;
    }

    /** @param ControllerEvent $event */
    public function notify($event)
    {
        if (APP_ENV==='dev') {
            
            $event->controller = new Debug($event->controller);
            //$event->controler .= 'info en plus';
        }
    }
}
