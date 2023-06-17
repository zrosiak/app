<?php
declare(strict_types=1);

namespace App\Ui\Api\Action;

use App\Application\Command\CreateEmployeeCommand;
use Symfony\Component\HttpFoundation\Response;
use App\Ui\Api\Response\CreateEmployeeResponse;
use Symfony\Component\Messenger\MessageBusInterface;

final class CreateEmployeeAction
{
    public function __construct(
        private MessageBusInterface $message_bus,
    ) {}

    public function __invoke(): Response
    {
        $result = $this->message_bus->dispatch(
            new CreateEmployeeCommand()
        );

        return (new CreateEmployeeResponse())($result);
    }
}
