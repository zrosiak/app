<?php

declare(strict_types=1);

namespace App\Domain\Enum;

use App\Domain\Provider\PaymentRateProviderInterface;

enum CountryCodeEnum implements PaymentRateProviderInterface
{
    case PL;
    case DE;
    case GB;

    public function rate(): int
    {
        return match ($this) {
            CountryCodeEnum::PL => 10,
            CountryCodeEnum::DE => 50,
            CountryCodeEnum::GB => 70,
        };
    }
}
