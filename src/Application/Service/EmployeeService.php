<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Employee;
use App\Domain\Factory\EmployeeFactory;
use App\Domain\Exception\EmployeeNotFoundException;
use App\Domain\Factory\DelegationFactory;
use App\Domain\Repository\DelegationRepositoryInterface;
use App\Domain\Repository\EmployeeRepositoryInterface;

final class EmployeeService
{
    public function __construct(
        private EmployeeFactory $employee_factory,
        private EmployeeRepositoryInterface $employee_repository,
        private DelegationFactory $delegation_factory,
        private DelegationRepositoryInterface $delegation_repository,
    ) {}

    public function createEmployee(): Employee
    {
        $employee = $this->employee_factory->create();

        $this->employee_repository->save($employee, true);

        return $employee;
    }

    public function addDelegation(
        int $employee_id,
        \DateTimeInterface $start_date,
        \DateTimeInterface $end_date,
        string $country
    ): void {
        $employee = $this->employee_repository->find($employee_id);

        if (!$employee) {
            throw new EmployeeNotFoundException();
        }

        $delegation = $this->delegation_factory->create(
            $employee,
            $start_date,
            $end_date,
            $country
        );
        $employee->addDelegation($delegation);

        $this->employee_repository->save($employee, true);
    }

    public function getDeleagtions(int $employee_id): array
    {
        $employee = $this->employee_repository->find($employee_id);

        if (!$employee) {
            throw new EmployeeNotFoundException();
        }

        return $employee->getDelegations()->toArray();
    }
}
