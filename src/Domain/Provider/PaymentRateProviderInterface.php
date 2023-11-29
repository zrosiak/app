<?php

declare(strict_types=1);

namespace App\Domain\Provider;

interface PaymentRateProviderInterface
{
    public function rate(): int;
}
