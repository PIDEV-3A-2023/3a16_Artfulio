<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="id_user_2", columns={"id_user"}), @ORM\Index(name="username", columns={"username"}), @ORM\Index(name="is_pro", columns={"is_pro"}), @ORM\Index(name="role", columns={"type_role"}), @ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="email_user", columns={"email_user"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="cin_user", type="string", length=8, nullable=false)
     */
    private $cinUser;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_user", type="string", length=50, nullable=false)
     */
    private $adresseUser;

    /**
     * @var string
     *
     * @ORM\Column(name="password_user", type="string", length=50, nullable=false)
     */
    private $passwordUser;

    /**
     * @var string
     *
     * @ORM\Column(name="email_user", type="string", length=50, nullable=false)
     */
    private $emailUser;

    /**
     * @var int
     *
     * @ORM\Column(name="is_pro", type="integer", nullable=false)
     */
    private $isPro = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="img_user", type="string", length=255, nullable=true)
     */
    private $imgUser;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_role", referencedColumnName="id_role")
     * })
     * @ORM\JoinColumn(nullable=true)

     */
    private $typeRole;

    public function getIdUser(): ?int
    {
        return $this->idUser;
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

    public function getCinUser(): ?string
    {
        return $this->cinUser;
    }

    public function setCinUser(string $cinUser): self
    {
        $this->cinUser = $cinUser;

        return $this;
    }

    public function getAdresseUser(): ?string
    {
        return $this->adresseUser;
    }

    public function setAdresseUser(string $adresseUser): self
    {
        $this->adresseUser = $adresseUser;

        return $this;
    }

    public function getPasswordUser(): ?string
    {
        return $this->passwordUser;
    }

    public function setPasswordUser(string $passwordUser): self
    {
        $this->passwordUser = $passwordUser;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->emailUser;
    }

    public function setEmailUser(string $emailUser): self
    {
        $this->emailUser = $emailUser;

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

    public function getImgUser(): ?string
    {
        return $this->imgUser;
    }

    public function setImgUser(?string $imgUser): self
    {
        $this->imgUser = $imgUser;

        return $this;
    }

    public function getTypeRole(): ?Role
    {
        return $this->typeRole;
    }

    public function setTypeRole(?Role $typeRole): self
    {
        $this->typeRole = $typeRole;

        return $this;
    }

    public function __toString()
    {
        return(string) $this->getIdUser();

    }


}
