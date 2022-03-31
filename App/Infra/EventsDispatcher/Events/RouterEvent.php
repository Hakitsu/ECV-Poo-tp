<?php

declare(strict_types=1);

namespace App\Infra\EventsDispatcher\Events;

use App\Infra\EventsDispatcher\Event;
use App\Routing\Router;

class RouterEvent extends Event
{
    public function __construct(public Router $router)
    {
    }
}
