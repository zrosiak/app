<?php
declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Employee;
use App\Domain\Entity\Delegation;
use App\Domain\ValueObject\Country;

final class DelegationFactory
{
    public function create(
        Employee $employee,
        \DateTimeInterface $start_date,
        \DateTimeInterface $end_date,
        Country $country
    ): Delegation {
        return new Delegation(
            $employee,
            $start_date,
            $end_date,
            $country,
        );
    }
}
