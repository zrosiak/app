<?php
declare(strict_types=1);

namespace App\Application\ActionHandler;

use App\Application\Service\EmployeeService;

final class AddDelegationHandler
{
    public function __construct(
        private EmployeeService $employee_service
    ) {}

    public function handle(
        int $employee_id,
        \DateTimeInterface $start_date,
        \DateTimeInterface $end_date,
        string $country
    ): void {
        $this->employee_service->addDelegation(
            $employee_id,
            $start_date,
            $end_date,
            $country
        );
    }
}
