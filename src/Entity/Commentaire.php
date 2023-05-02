<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="IDX_67F068BC56826C06", columns={"id_artwork"}), @ORM\Index(name="IDX_67F068BC5546AEA1", columns={"id_util"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_com", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCom;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="string", length=255, nullable=false)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_post", type="date", nullable=false)
     */
    private $datePost;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_util", referencedColumnName="id_user")
     * })
     */
    private $idUtil;

    /**
     * @var \Artwork
     *
     * @ORM\ManyToOne(targetEntity="Artwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_artwork", referencedColumnName="id_artwork")
     * })
     */
    private $idArtwork;

    public function getIdCom(): ?int
    {
        return $this->idCom;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->datePost;
    }

    public function setDatePost(\DateTimeInterface $datePost): self
    {
        $this->datePost = $datePost;

        return $this;
    }

    public function getIdUtil(): ?User
    {
        return $this->idUtil;
    }

    public function setIdUtil(?User $idUtil): self
    {
        $this->idUtil = $idUtil;

        return $this;
    }

    public function getIdArtwork(): ?Artwork
    {
        return $this->idArtwork;
    }

    public function setIdArtwork(?Artwork $idArtwork): self
    {
        $this->idArtwork = $idArtwork;

        return $this;
    }


}
