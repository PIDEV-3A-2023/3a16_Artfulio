<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artwork
 *
 * @ORM\Table(name="artwork", indexes={@ORM\Index(name="fk_id_type", columns={"id_type_id"}), @ORM\Index(name="fk_id_artist", columns={"id_artist_id"})})
 * @ORM\Entity
 */
class Artwork
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_artwork", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_artwork", type="string", length=255, nullable=false)
     */
    private $nomArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="description_artwork", type="string", length=255, nullable=false)
     */
    private $descriptionArtwork;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_artwork", type="integer", nullable=false)
     */
    private $prixArtwork;

    /**
     * @var int
     *
     * @ORM\Column(name="id_type_id", type="integer", nullable=false)
     */
    private $idTypeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="id_artist_id", type="integer", nullable=false)
     */
    private $idArtistId;

    /**
     * @var string
     *
     * @ORM\Column(name="lien_artwork", type="string", length=255, nullable=false)
     */
    private $lienArtwork;

    /**
     * @var int
     *
     * @ORM\Column(name="dimension_artwork", type="integer", nullable=false)
     */
    private $dimensionArtwork;

    /**
     * @var string
     *
     * @ORM\Column(name="img_artwork", type="string", length=255, nullable=false)
     */
    private $imgArtwork;

    /**
     * @var int
     *
     * @ORM\Column(name="likes_count", type="integer", nullable=false)
     */
    private $likesCount;


}
