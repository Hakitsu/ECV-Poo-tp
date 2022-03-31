<?php

declare(strict_types=1);

namespace App\Infra\EventsDispatcher;

class Dispatcher
{
    /**
     * @var array<ListenerInterface>
     */
    private array $listeners = [];

    public function addListeners(ListenerInterface ...$listeners)
    {
        $this->listeners = array_merge($this->listeners, $listeners);
    }

    public function dispatch(EventInterface $event)
    {
        foreach ($this->listeners as $listener) {
            if ($listener->support($event)) {
                $listener->notify($event);
            }

            if ($event->isPropagationStopped()) {
                break;
            }
        }
    }
}
