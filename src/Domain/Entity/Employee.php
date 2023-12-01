<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Domain\Entity\Delegation;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Delegation>
     */
    #[ORM\OneToMany(mappedBy: 'employee', targetEntity: Delegation::class, orphanRemoval: true, cascade: ['persist', 'remove'])]
    private Collection $delegations;

    public function __construct()
    {
        $this->delegations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Delegation>
     */
    public function getDelegations(): Collection
    {
        return $this->delegations;
    }

    public function addDelegation(Delegation $delegation): void
    {
        if (!$this->delegations->contains($delegation)) {
            $this->delegations->add($delegation);
        }
    }

    public function removeDelegation(Delegation $delegation): void
    {
        $this->delegations->removeElement($delegation);
    }
}
