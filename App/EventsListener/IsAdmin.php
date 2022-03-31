<?php

declare(strict_types=1);

namespace App\EventsListener;

use App\Controller\NewPlayer;
use App\Infra\EventsDispatcher\Events\ControllerEvent;
use App\Infra\EventsDispatcher\ListenerInterface;

class IsAdmin implements ListenerInterface
{
    private array $securedControllers = [
        NewPlayer::class
    ];

    public function support($event): bool
    {
        return $event instanceof ControllerEvent;
    }

    /** @param ControllerEvent $event */
    public function notify($event)
    {
        if (in_array($event->controller::class, $this->securedControllers) && !($event->router::getUser()['isAdmin'] ?? false)) {
            header("HTTP/1.1 403 Access Denied");
            echo 'forbidden';
            die;
        }
    }
}
