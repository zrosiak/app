<?php
declare(strict_types=1);

namespace App\Application\Query;

final readonly class DelegationsListQuery
{
    public function __construct(
        public readonly int $employee_id
    ) {}
}
