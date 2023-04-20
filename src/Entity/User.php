<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="is_pro", columns={"is_pro"}), @ORM\Index(name="username", columns={"username"}), @ORM\Index(name="role", columns={"type_role"}), @ORM\Index(name="email_user", columns={"email_user"})})
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
     * @var string
     *
     * @ORM\Column(name="type_role", type="string", length=20, nullable=false)
     */
    private $typeRole;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_pro", type="boolean", nullable=false)
     */
    private $isPro;

    /**
     * @var string|null
     *
     * @ORM\Column(name="img_user", type="string", length=255, nullable=true)
     */
    private $imgUser;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventLike", mappedBy="user")
     */
    private Collection $likes;


    public function getIdUser(): ?int
    {
        return $this->idUser;
    }
    public function setIdUser($id): self
    {
        $this->idUser = $id;
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

    public function getTypeRole(): ?string
    {
        return $this->typeRole;
    }

    public function setTypeRole(string $typeRole): self
    {
        $this->typeRole = $typeRole;

        return $this;
    }

    public function isIsPro(): ?bool
    {
        return $this->isPro;
    }

    public function setIsPro(bool $isPro): self
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

    //---------------------------------------------------------------------

    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(EventLike $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(EventLike $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }
}
