<?php

namespace App\Domain\Dice\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Player\Entity\Player;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"post"}},
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
     * @var Dice
     */
    private $dice1;

    /**
     * @Groups({"post_roll", "get"})
     * @var Dice
     */
    private $dice2;

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
     * @return Player
     */
    public function getDice1(): Player
    {
        return $this->dice1;
    }

    /**
     * @param Player $dice1
     */
    public function setDice1(Player $dice1): void
    {
        $this->dice1 = $dice1;
    }

    /**
     * @return Player
     */
    public function getDice2(): Player
    {
        return $this->dice2;
    }

    /**
     * @param Player $dice2
     */
    public function setDice2(Player $dice2): void
    {
        $this->dice2 = $dice2;
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
