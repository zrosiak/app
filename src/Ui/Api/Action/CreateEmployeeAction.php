<?php

declare(strict_types=1);

namespace App\Ui\Api\Action;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Ui\Api\Response\CreateEmployeeResponse;
use App\Application\Command\CreateEmployeeCommand;
use App\Application\MessageBus\CommandBusInterface;

final class CreateEmployeeAction
{
    public function __construct(
        private CommandBusInterface $command_bus,
    ) {}

    public function __invoke(Request $request): Response
    {
        $result = $this->command_bus->dispatch(
            new CreateEmployeeCommand()
        );

        return (new CreateEmployeeResponse())($result);
    }
}
