<?php

declare(strict_types=1);

namespace App\Infra\EventsDispatcher;

abstract class Event implements EventInterface
{
    protected bool $propagationStopped = false;

    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }
}
