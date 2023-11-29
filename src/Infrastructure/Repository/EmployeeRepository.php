<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Employee;
use App\Domain\Repository\EmployeeRepositoryInterface;

class EmployeeRepository extends AbstractDoctrineRepository implements EmployeeRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return Employee::class;
    }

    public function save(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Employee $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getById(int $id): ?Employee
    {
        return $this->getRepository()->find($id);
    }
}
