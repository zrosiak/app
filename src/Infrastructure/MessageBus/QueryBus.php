<?php

declare(strict_types=1);

namespace App\Infrastructure\MessageBus;

use App\Application\Query\QueryInterface;
use App\Application\MessageBus\QueryBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class QueryBus implements QueryBusInterface
{
    public function __construct(
        private MessageBusInterface $message_bus,
    ) {}

    public function dispatch(QueryInterface $query): mixed
    {
        $envelope = $this->message_bus->dispatch($query);
        /** @var HandledStamp[] $handled_stamps */
        $handled_stamps = $envelope->all(HandledStamp::class);

        return array_shift($handled_stamps)?->getResult();
    }
}
