<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Employee;
use App\Domain\ValueObject\Country;
use App\Domain\Factory\EmployeeFactory;
use App\Domain\Factory\DelegationFactory;
use App\Domain\Exception\EmployeeNotFoundException;
use App\Domain\Repository\EmployeeRepositoryInterface;
use App\Domain\Repository\DelegationRepositoryInterface;

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
        Country $country,
    ): void {
        $employee = $this->employee_repository->getById($employee_id);

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

    /**
     * @return array<int, \App\Domain\Entity\Delegation> $delegations
     */
    public function getDeleagtions(int $employee_id): array
    {
        $employee = $this->employee_repository->getById($employee_id);

        if (!$employee) {
            throw new EmployeeNotFoundException();
        }

        return $employee->getDelegations()->toArray();
    }
}
