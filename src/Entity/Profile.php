<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity
 */
class Profile
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_profil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProfil;

    /**
     * @var int
     *
     * @ORM\Column(name="id_util", type="integer", nullable=false)
     */
    private $idUtil;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="string", length=255, nullable=false)
     */
    private $bio;

    /**
     * @var string
     *
     * @ORM\Column(name="ig", type="string", length=255, nullable=false)
     */
    private $ig;

    /**
     * @var string
     *
     * @ORM\Column(name="fb", type="string", length=255, nullable=false)
     */
    private $fb;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=false)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="ytb", type="string", length=255, nullable=false)
     */
    private $ytb;

    public function getIdProfil(): ?int
    {
        return $this->idProfil;
    }

    public function getIdUtil(): ?int
    {
        return $this->idUtil;
    }

    public function setIdUtil(int $idUtil): self
    {
        $this->idUtil = $idUtil;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getIg(): ?string
    {
        return $this->ig;
    }

    public function setIg(string $ig): self
    {
        $this->ig = $ig;

        return $this;
    }

    public function getFb(): ?string
    {
        return $this->fb;
    }

    public function setFb(string $fb): self
    {
        $this->fb = $fb;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getYtb(): ?string
    {
        return $this->ytb;
    }

    public function setYtb(string $ytb): self
    {
        $this->ytb = $ytb;

        return $this;
    }


}
