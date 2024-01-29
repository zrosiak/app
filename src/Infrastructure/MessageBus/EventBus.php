<?php

declare(strict_types=1);

namespace App\Infrastructure\MessageBus;

use App\Application\Event\EventInterface;
use App\Application\MessageBus\EventBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class EventBus implements EventBusInterface
{
    public function __construct(
        private MessageBusInterface $event_bus,
    ) {}

    public function dispatch(EventInterface $event): void
    {
        $this->event_bus->dispatch($event);
    }
}
