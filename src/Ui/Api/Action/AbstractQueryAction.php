<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use App\Application\Query\QueryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Application\MessageBus\QueryBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractQueryAction implements QueryBusInterface
{
    public function __construct(
        private MessageBusInterface $message_bus,
    ) {}

    abstract public function __invoke(Request $request): Response;

    public function dispatch(QueryInterface $query): mixed
    {
        $envelope = $this->message_bus->dispatch($query);
        /** @var HandledStamp[] $handledStamps */
        $handledStamps = $envelope->all(HandledStamp::class);

        return array_shift($handledStamps)?->getResult();
    }
}
