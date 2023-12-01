<?php

declare(strict_types=1);

namespace App\Application\CommandHandler;

use App\Application\Service\EmployeeService;
use App\Application\Command\CreateEmployeeCommand;
use App\Application\Payload\CreateEmployeePayload;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CreateEmployeeHandler
{
    public function __construct(
        private EmployeeService $employee_service
    ) {}

    public function __invoke(CreateEmployeeCommand $command): CreateEmployeePayload
    {
        $employee = $this->employee_service->createEmployee();

        return new CreateEmployeePayload($employee->getId());
    }
}
