<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pointderelais
 *
 * @ORM\Table(name="pointderelais", indexes={@ORM\Index(name="fk_id_livreurp", columns={"fk_id_livreurp"})})
 * @ORM\Entity
 */
class Pointderelais
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pointderelais", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPointderelais;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_pointderelais", type="string", length=255, nullable=false)
     */
    private $adressePointderelais;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_pointderelais", type="integer", nullable=false)
     */
    private $prixPointderelais;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_pointderelais", type="date", nullable=false)
     */
    private $datePointderelais;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_id_livreurp", referencedColumnName="id")
     * })
     */
    private $fkIdLivreurp;

    public function getIdPointderelais(): ?int
    {
        return $this->idPointderelais;
    }

    public function getAdressePointderelais(): ?string
    {
        return $this->adressePointderelais;
    }

    public function setAdressePointderelais(string $adressePointderelais): self
    {
        $this->adressePointderelais = $adressePointderelais;

        return $this;
    }

    public function getPrixPointderelais(): ?int
    {
        return $this->prixPointderelais;
    }

    public function setPrixPointderelais(int $prixPointderelais): self
    {
        $this->prixPointderelais = $prixPointderelais;

        return $this;
    }

    public function getDatePointderelais(): ?\DateTimeInterface
    {
        return $this->datePointderelais;
    }

    public function setDatePointderelais(\DateTimeInterface $datePointderelais): self
    {
        $this->datePointderelais = $datePointderelais;

        return $this;
    }

    public function getFkIdLivreurp(): ?User
    {
        return $this->fkIdLivreurp;
    }

    public function setFkIdLivreurp(?User $fkIdLivreurp): self
    {
        $this->fkIdLivreurp = $fkIdLivreurp;

        return $this;
    }


}
