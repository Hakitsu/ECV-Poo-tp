<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Infra\EventsDispatcher\Events\RouterEvent;
use App\Infra\EventsDispatcher\ListenerInterface;

class IsAuthenticated implements ListenerInterface
{
    public function support($event): bool
    {
        return $event instanceof RouterEvent;
    }

    /** @param RouterEvent $event */
    public function notify($event)
    {
        if (null === $event->router::getUser()) {
            header("HTTP/1.1 401 Unauthorized");
            echo 'non autorisé';
            die;
        }
    }
}
