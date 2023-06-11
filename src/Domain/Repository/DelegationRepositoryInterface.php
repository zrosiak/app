<?php
declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Delegation;

interface DelegationRepositoryInterface
{
    public function save(Delegation $entity, bool $flush = false): void;

    public function remove(Delegation $entity, bool $flush = false): void;
}
