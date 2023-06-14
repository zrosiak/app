<?php
declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Enum\CountryCodeEnum;
use App\Domain\Exception\WrongCountryCodeException;

final readonly class Country
{
    public function __construct(private readonly CountryCodeEnum $code)
    {}

    public static function fromString(string $code_name): self
    {
        foreach (CountryCodeEnum::cases() as $country_code) {
            if ($country_code->name === $code_name) {
                return new self($country_code);
            }
        }

        throw new WrongCountryCodeException();
    }

    public function __toString()
    {
        return $this->code->name;
    }
}
