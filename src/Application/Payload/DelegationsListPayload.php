<?php

declare(strict_types=1);

namespace App\Application\Payload;

final readonly class DelegationsListPayload
{
    /**
     * @param array<int, \App\Domain\Entity\Delegation> $delegations
     */
    public function __construct(public readonly array $delegations)
    {
    }
}
