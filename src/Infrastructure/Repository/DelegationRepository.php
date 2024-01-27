<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use DateTimeInterface;
use App\Domain\Entity\Employee;
use App\Domain\Entity\Delegation;
use App\Domain\Repository\DelegationRepositoryInterface;
use App\Infrastructure\Repository\AbstractDoctrineRepository;

class DelegationRepository extends AbstractDoctrineRepository implements DelegationRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return Delegation::class;
    }

    public function save(Delegation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Delegation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByDateAndEmployee(
        Employee $employee,
        DateTimeInterface $date_from,
        DateTimeInterface $date_to,
    ): ?Delegation {
        return $this->getRepository()->findOneBy(['employee' => $employee]);
    }
}
