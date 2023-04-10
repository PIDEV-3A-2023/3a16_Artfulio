<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_id_user", columns={"id_util"}), @ORM\Index(name="fk_id_artwork", columns={"id_artwork"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_util", type="integer", nullable=false)
     */
    private $idUtil;

    /**
     * @var string
     *
     * @ORM\Column(name="Texte", type="string", length=200, nullable=false)
     */
    private $texte;

    /**
     * @var int
     *
     * @ORM\Column(name="Id_com", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCom;

    /**
     * @var int
     *
     * @ORM\Column(name="id_artwork", type="integer", nullable=false)
     */
    private $idArtwork;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_post", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datePost = 'CURRENT_TIMESTAMP';

    public function getIdUtil(): ?int
    {
        return $this->idUtil;
    }

    public function setIdUtil(int $idUtil): self
    {
        $this->idUtil = $idUtil;

        return $this;
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

    public function getIdCom(): ?int
    {
        return $this->idCom;
    }

    public function getIdArtwork(): ?int
    {
        return $this->idArtwork;
    }

    public function setIdArtwork(int $idArtwork): self
    {
        $this->idArtwork = $idArtwork;

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


}
