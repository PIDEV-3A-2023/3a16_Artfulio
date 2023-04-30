<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MessengerMessages
 *
 * @ORM\Table(name="messenger_messages", indexes={@ORM\Index(name="IDX_75EA56E0FB7336F0", columns={"queue_name"}), @ORM\Index(name="IDX_75EA56E0E3BD61CE", columns={"available_at"}), @ORM\Index(name="IDX_75EA56E016BA31DB", columns={"delivered_at"})})
 * @ORM\Entity
 */
class MessengerMessages
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=0, nullable=false)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="headers", type="text", length=0, nullable=false)
     */
    private $headers;

    /**
     * @var string
     *
     * @ORM\Column(name="queue_name", type="string", length=190, nullable=false)
     */
    private $queueName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="available_at", type="datetime", nullable=false)
     */
    private $availableAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="delivered_at", type="datetime", nullable=true)
     */
    private $deliveredAt;


}
