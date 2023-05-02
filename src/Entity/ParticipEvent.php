<?php

namespace App\Entity;

use App\Repository\ParticipEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParticipEventRepository::class)]
class ParticipEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'participEvents')]
    private ?Artist $user = null;

    #[ORM\ManyToOne(inversedBy: 'participes')]
    private ?Evenement $evenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Artist
    {
        return $this->user;
    }

    public function setUser(?Artist $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
