<?php

declare(strict_types=1);

namespace App\Infrastructure\MessageBus;

use App\Application\Command\CommandInterface;
use App\Application\MessageBus\CommandBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $message_bus,
    ) {}

    public function dispatch(CommandInterface $command): mixed
    {
        $envelope = $this->message_bus->dispatch($command);
        /** @var HandledStamp[] $handled_stamps */
        $handled_stamps = $envelope->all(HandledStamp::class);

        return array_shift($handled_stamps)?->getResult();
    }
}
