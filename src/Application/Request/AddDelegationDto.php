<?php

declare(strict_types=1);

namespace App\Application\Request;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

final class AddDelegationDto
{
    public function __construct(
        #[Type('integer')]
        #[NotBlank()]
        public readonly int $employee_id,

        #[NotBlank()]
        public readonly DateTimeImmutable $start_date,

        #[NotBlank()]
        #[Assert\GreaterThan(propertyPath: 'start_date')]
        public readonly DateTimeImmutable $end_date,

        #[Type('string')]
        #[NotBlank()]
        public readonly string $country,
    ) {

    }
}
