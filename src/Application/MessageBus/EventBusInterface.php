<?php

declare(strict_types=1);

namespace App\Application\MessageBus;

use App\Application\Event\EventInterface;

interface EventBusInterface
{
    public function dispatch(EventInterface $event): mixed;
}
