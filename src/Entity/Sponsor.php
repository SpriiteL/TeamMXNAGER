<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorRepository::class)]
class Sponsor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $contract_value = null;

    #[ORM\Column]
    private ?int $contract_duration = null;

    #[ORM\ManyToOne(inversedBy: 'sponsors')]
    private ?Team $team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getContractValue(): ?float
    {
        return $this->contract_value;
    }

    public function setContractValue(float $contract_value): static
    {
        $this->contract_value = $contract_value;

        return $this;
    }

    public function getContractDuration(): ?int
    {
        return $this->contract_duration;
    }

    public function setContractDuration(int $contract_duration): static
    {
        $this->contract_duration = $contract_duration;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): static
    {
        $this->team = $team;

        return $this;
    }
}
