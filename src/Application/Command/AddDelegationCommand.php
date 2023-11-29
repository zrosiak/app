<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\ValueObject\Country;
use App\Application\Command\CommandInterface;

final readonly class AddDelegationCommand implements CommandInterface
{
    public function __construct(
        public readonly int $employee_id,
        public readonly \DateTimeInterface $start_date,
        public readonly \DateTimeInterface $end_date,
        public readonly Country $country
    ) {}
}
