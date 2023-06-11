<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use App\Repository\DelegationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DelegationRepository::class)]
class Delegation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column(length: 2)]
    private ?string $country = null;

    #[ORM\ManyToOne(inversedBy: 'delegations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    public function __construct(
        Employee $employee,
        \DateTimeInterface $start_date,
        \DateTimeInterface $end_date,
        string $country
    ) {
        $this->employee = $employee;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->country = $country;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }
}
