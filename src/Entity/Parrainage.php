<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parrainage
 *
 * @ORM\Table(name="parrainage")
 * @ORM\Entity
 */
class Parrainage
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_parrainage", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idParrainage;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var int
     *
     * @ORM\Column(name="is_pro", type="integer", nullable=false)
     */
    private $isPro;

    /**
     * @var string
     *
     * @ORM\Column(name="type_role", type="string", length=255, nullable=false)
     */
    private $typeRole;

    public function getIdParrainage(): ?int
    {
        return $this->idParrainage;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getIsPro(): ?int
    {
        return $this->isPro;
    }

    public function setIsPro(int $isPro): self
    {
        $this->isPro = $isPro;

        return $this;
    }

    public function getTypeRole(): ?string
    {
        return $this->typeRole;
    }

    public function setTypeRole(string $typeRole): self
    {
        $this->typeRole = $typeRole;

        return $this;
    }


}
