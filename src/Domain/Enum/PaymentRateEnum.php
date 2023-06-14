<?php
declare(strict_types=1);

namespace App\Domain\Enum;

use App\Domain\Enum\CountryCodeEnum;
use App\Domain\Provider\PaymentRateProviderInterface;

Enum PaymentRateEnum implements PaymentRateProviderInterface
{
    public function rate(): int
    {
        return match($this)
        {
            CountryCodeEnum::PL => 10,
            CountryCodeEnum::DE => 50,
            CountryCodeEnum::GB => 70,
        };
    }
}
