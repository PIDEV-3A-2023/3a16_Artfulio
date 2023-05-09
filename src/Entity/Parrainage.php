<?php

namespace App\Entity;

use App\Repository\ParrainageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Artist;

#[ORM\Entity(repositoryClass: ParrainageRepository::class)]
class Parrainage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_parrainage = null;
    #[ORM\Column]
    private ?int $id_user_id = null;

    #[ORM\ManyToOne(inversedBy: 'parrainages')]
    private ?Artist $idUser = null;

    public function getIdParrainage(): ?int
    {
        return $this->id_parrainage;
    }

    public function getIdUser(): ?Artist
    {
        return $this->idUser;
    }

    public function setIdUser(?Artist $idUser): self
    {
        $this->idUser = $idUser;

        return $this;

    }
    public function setIdUserz(?int $idUser): self
    {
        $this->id_user_id = $idUser;

        return $this;
    }
}
