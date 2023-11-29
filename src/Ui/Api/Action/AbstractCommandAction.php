<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use App\Application\Command\CommandInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Application\MessageBus\CommandBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractCommandAction implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $message_bus,
    ) {}

    abstract public function __invoke(Request $request): Response;

    public function dispatch(CommandInterface $command): mixed
    {
        $envelope = $this->message_bus->dispatch($command);
        /** @var HandledStamp[] $handledStamps */
        $handledStamps = $envelope->all(HandledStamp::class);

        return array_shift($handledStamps)?->getResult();
    }
}
