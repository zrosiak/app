<?php
declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Query\QueryInterface;

final readonly class DelegationsListQuery implements QueryInterface
{
    public function __construct(
        public readonly int $employee_id
    ) {}
}
