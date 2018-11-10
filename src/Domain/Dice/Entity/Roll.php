<?php

namespace App\Domain\Dice\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Player\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"get"}},
 *              "denormalization_context"={"groups"={"post_roll"}}
 *      }
 *     },
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * )
 */
class Roll
{
    /**
     * @var int
     */
    private $id;

    /**
     * @Groups({"post_roll", "get"})
     * @var Player
     */
    private $player;

    /**
     * @Groups({"post_roll", "get"})
     * @var ArrayCollection
     */
    private $dices;

    /**
     * @Groups({ "get"})
     * @var \DateTime
     */
    private $creationDate;

    /**
     * Roll constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @param Player $player
     */
    public function setPlayer(Player $player): void
    {
        $this->player = $player;
    }

    /**
     * @return ArrayCollection
     */
    public function getDices(): iterable
    {
        return $this->dices;
    }

    /**
     * @param array $dices
     */
    public function setDices(array $dices): void
    {
        $this->dices = $dices;
    }

    /**
     * @param Dice $dice
     */
    public function addDice(Dice $dice): void
    {
        $this->dices[] = $dice;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }
}
