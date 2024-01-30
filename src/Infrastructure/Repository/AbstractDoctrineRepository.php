<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository as ObjectRepositoryInterface;

abstract class AbstractDoctrineRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entity_manager
    ) {
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return $this->entity_manager;
    }

    protected function getRepository(): ObjectRepositoryInterface
    {
        return $this->entity_manager->getRepository($this->getEntityClass());
    }

    protected function createQueryBuilder(): QueryBuilder
    {
        return $this->entity_manager->createQueryBuilder();
    }

    abstract protected function getEntityClass(): string;
}
