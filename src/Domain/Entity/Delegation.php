<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Country;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Delegation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\DateTime()]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $start_date;

    #[Assert\DateTime()]
    #[Assert\GreaterThan(propertyPath: 'start_date')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $end_date;

    #[Assert\Length(exactly: 2)]
    #[ORM\Column(length: 2)]
    private string $country;

    #[Assert\NotBlank]
    #[ORM\ManyToOne(inversedBy: 'delegations')]
    #[ORM\JoinColumn(nullable: false)]
    private Employee $employee;

    public function __construct(
        Employee $employee,
        \DateTimeInterface $start_date,
        \DateTimeInterface $end_date,
        Country $country
    ) {
        $this->employee = $employee;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->country = (string) $country;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): \DateTimeInterface
    {
        return $this->start_date;
    }

    public function getEndDate(): \DateTimeInterface
    {
        return $this->end_date;
    }

    public function getCountry(): Country
    {
        return Country::fromString($this->country);
    }

    public function getEmployee(): Employee
    {
        return $this->employee;
    }
}
