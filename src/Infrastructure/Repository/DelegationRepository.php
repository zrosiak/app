<?php
declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Delegation;
use Doctrine\Persistence\ManagerRegistry;
use App\Domain\Repository\DelegationRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Delegation>
 *
 * @method Delegation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delegation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delegation[]    findAll()
 * @method Delegation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DelegationRepository extends ServiceEntityRepository implements DelegationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delegation::class);
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
