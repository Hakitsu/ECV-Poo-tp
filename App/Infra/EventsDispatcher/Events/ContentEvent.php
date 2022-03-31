<?php

declare(strict_types=1);

namespace App\Infra\EventsDispatcher\Events;

use App\Controller\Controller;
use App\Infra\EventsDispatcher\Event;
use App\Routing\Router;

class ContentEvent extends Event
{
    public function __construct(public string $content)
    {
    }
}
