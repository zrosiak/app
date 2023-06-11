<?php
declare(strict_types=1);

namespace App\Application\Payload;

final readonly class DelegationsListPayload
{
    public function __construct(
        public readonly array $delegations
    ) {}
}
