<?php
declare(strict_types=1);

namespace App\Ui\Api\Action;

use App\Application\Command\AddDelegationCommand;
use DateTimeImmutable;
use App\Domain\ValueObject\Country;
use Symfony\Component\HttpFoundation\Request;
use App\Ui\Api\Response\AddDelegationResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

final class AddDelegationAction
{
    public function __construct(
        private MessageBusInterface $message_bus,
    ) {}

    public function __invoke(Request $request): Response
    {
        $result = $this->message_bus->dispatch(
            new AddDelegationCommand(
                (int) $request->get('id') ?: null,
                new DateTimeImmutable($request->get('start')),
                new DateTimeImmutable($request->get('end')),
                Country::fromString($request->get('country')),
            )
        );

        return (new AddDelegationResponse())($result);
    }
}
