<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feedback
 *
 * @ORM\Table(name="feedback", indexes={@ORM\Index(name="fk_id_user", columns={"fk_id_user"}), @ORM\Index(name="fk_id_produit", columns={"fk_id_produit"}), @ORM\Index(name="fk_id_service", columns={"fk_id_sevice"})})
 * @ORM\Entity
 */
class Feedback
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_feedback", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFeedback;

    /**
     * @var bool
     *
     * @ORM\Column(name="favoris", type="boolean", nullable=false)
     */
    private $favoris;

    /**
     * @var int
     *
     * @ORM\Column(name="fk_id_user", type="integer", nullable=false)
     */
    private $fkIdUser;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_sevice", referencedColumnName="id_service")
     * })
     */
    private $fkIdSevice;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_produit", referencedColumnName="id_produit")
     * })
     */
    private $fkIdProduit;

    public function getIdFeedback(): ?int
    {
        return $this->idFeedback;
    }

    public function isFavoris(): ?bool
    {
        return $this->favoris;
    }

    public function setFavoris(bool $favoris): self
    {
        $this->favoris = $favoris;

        return $this;
    }

    public function getFkIdUser(): ?int
    {
        return $this->fkIdUser;
    }

    public function setFkIdUser(int $fkIdUser): self
    {
        $this->fkIdUser = $fkIdUser;

        return $this;
    }

    public function getFkIdSevice(): ?Service
    {
        return $this->fkIdSevice;
    }

    public function setFkIdSevice(?Service $fkIdSevice): self
    {
        $this->fkIdSevice = $fkIdSevice;

        return $this;
    }

    public function getFkIdProduit(): ?Produit
    {
        return $this->fkIdProduit;
    }

    public function setFkIdProduit(?Produit $fkIdProduit): self
    {
        $this->fkIdProduit = $fkIdProduit;

        return $this;
    }


}
