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


}
