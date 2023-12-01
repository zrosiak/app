<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Service\EmployeeService;
use App\Application\Command\AddDelegationCommand;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class AddDelegationHandler
{
    public function __construct(
        private EmployeeService $employee_service
    ) {
    }

    public function __invoke(AddDelegationCommand $command): void
    {
        $this->employee_service->addDelegation(
            $command->employee_id,
            $command->start_date,
            $command->end_date,
            $command->country,
        );
    }
}
