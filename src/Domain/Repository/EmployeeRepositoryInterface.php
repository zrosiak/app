<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Employee;

interface EmployeeRepositoryInterface
{
    public function save(Employee $entity, bool $flush = false): void;

    public function remove(Employee $entity, bool $flush = false): void;

    public function getById(int $id): ?Employee;
}
