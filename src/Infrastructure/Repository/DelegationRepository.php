<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Delegation;
use App\Infrastructure\Repository\AbstractDoctrineRepository;
use App\Domain\Repository\DelegationRepositoryInterface;

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
}
