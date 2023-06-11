<?php
declare(strict_types=1);

namespace App\Application\Payload;

final readonly class CreateEmployeePayload
{
    public function __construct(
        public readonly int $id
    ) {}
}
