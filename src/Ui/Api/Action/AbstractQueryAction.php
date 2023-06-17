<?php
declare(strict_types=1);

namespace App\Ui\Api\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractQueryAction
{
    public function __construct(
        private MessageBusInterface $message_bus,
    ) {}

    abstract public function __invoke(Request $request): Response;

    protected function query(object $message): mixed
    {
        $envelope = $this->message_bus->dispatch($message);
        /** @var HandledStamp[] $handledStamps */
        $handledStamps = $envelope->all(HandledStamp::class);

        return $handledStamps[0]->getResult();
    }
}
