<?php
declare(strict_types=1);

namespace App\Application\ActionHandler;

use App\Application\Service\EmployeeService;
use App\Application\Payload\CreateEmployeePayload;

final class CreateEmployeeHandler
{
    public function __construct(
        private EmployeeService $employee_service
    ) {}

    public function handle(): CreateEmployeePayload
    {
        $employee = $this->employee_service->createEmployee();

        return new CreateEmployeePayload($employee->getId());
    }
}
