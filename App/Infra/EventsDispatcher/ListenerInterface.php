<?php

declare(strict_types=1);

namespace App\Infra\EventsDispatcher;

interface ListenerInterface
{
    public function support($event): bool;
    public function notify($event);
}
