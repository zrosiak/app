<?php
declare(strict_types=1);

namespace App\Domain\Enum;

Enum PaymentRateEnum: int
{
    case PL = 10;
    case DE = 50;
    case GB = 70;
}
