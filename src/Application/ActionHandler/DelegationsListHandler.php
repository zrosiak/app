<?php
declare(strict_types=1);

namespace App\Application\ActionHandler;

use App\Domain\Service\EmployeeService;
use App\Application\Payload\DelegationsListPayload;

final class DelegationsListHandler
{
    public function __construct(
        private EmployeeService $employee_service
    ) {}

    public function handle(int $employee_id): DelegationsListPayload
    {
        $delegations = $this->employee_service->getDeleagtions($employee_id);

        return new DelegationsListPayload($delegations);
    }
}
