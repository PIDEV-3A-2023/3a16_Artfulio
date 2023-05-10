<?php

namespace App\Entity;

use App\Repository\LoginRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: LoginRepository::class)]
class Login implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $username = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]

    private ?User $password = null;

    #[ORM\Column(length: 255)]
    #[ORM\JoinColumn(nullable: false)]

    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?User
    {
        return $this->username;
    }

    public function setUsername(User $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?User
    {
        return $this->password;
    }

    public function setPassword(?User $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getSalt()
    {
        return NUll;  
      }
      public function eraseCredentials()
      {
          // Remove sensitive data from the user
      }
      public function getRoles()
      {
          // Return an array of user roles
      }
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
