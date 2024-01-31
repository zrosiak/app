<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateInterval;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\ValueObject\Country;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Delegation
{
    private const DAYS_TO_DOUBLE_RATE = 7;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\DateTime()]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface $start_date;

    #[Assert\DateTime()]
    #[Assert\GreaterThan(propertyPath: 'start_date')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private DateTimeInterface $end_date;

    #[Assert\Length(exactly: 2)]
    #[ORM\Column(length: 2)]
    private string $country;

    #[Assert\NotBlank]
    #[ORM\ManyToOne(inversedBy: 'delegations')]
    #[ORM\JoinColumn(nullable: false)]
    private Employee $employee;

    public function __construct(
        Employee $employee,
        DateTimeInterface $start_date,
        DateTimeInterface $end_date,
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

    public function getStartDate(): DateTimeInterface
    {
        return $this->start_date;
    }

    public function getEndDate(): DateTimeInterface
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

    public function getAmountDue(): float
    {
        $amount_due = $this->calculateWorkingDaysCount($this->start_date, $this->end_date) * $this->getCountry()->rate();
        $is_eligible_for_double_rate = $this->start_date->diff($this->end_date)->format('%d') > self::DAYS_TO_DOUBLE_RATE;

        if ($is_eligible_for_double_rate) {
            $double_rate_start_date = (new DateTime($this->start_date->format('Y-m-d H:i:s')))->add(
                new DateInterval('P' . self::DAYS_TO_DOUBLE_RATE . 'D')
            );
            $amount_due += $this->calculateWorkingDaysCount(
                $double_rate_start_date,
                $this->end_date
            ) * $this->getCountry()->rate();
        }

        return $amount_due;
    }

    private function calculateWorkingDaysCount(DateTimeInterface $start_date, DateTimeInterface $end_date): int
    {
        $days_count = (int) $start_date->diff($end_date)->format('%d');
        $first_day = (int) $start_date->format('N');
        $whole_weeks_count = (int) (($days_count - $first_day) / 7);
        $working_days_count = min(0, 5 - $first_day)
            + 5 * $whole_weeks_count
            + min(5, ($days_count - $first_day) % 7);

        return $working_days_count;
    }
}
