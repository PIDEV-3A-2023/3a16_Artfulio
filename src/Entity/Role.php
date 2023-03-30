<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Repository;
use App\Repository\RoleRepository;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_role   = null;
    #[ORM\Column(length: 255)]
    private ?string $type_role  = null;
   

    public function getIdRole(): ?int
    {
        return $this->id_role ;
    }

    public function getTypeRole(): ?string
    {
        return $this->type_role ;
    }

    public function setTypeRole(string $typeRole): self
    {
        $this->type_role  = $typeRole;

        return $this;
    }


}
