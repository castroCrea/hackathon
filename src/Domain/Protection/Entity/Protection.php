<?php

namespace App\Domain\Protection\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Dice\Entity\DiceType;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *      }
 *     },
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * )
 */
class Protection
{
    /**
     * @var int
     */
    private $id;

    /**
     * @Groups({"get"})
     * @var string
     */
    private $name;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $level;

    /**
     * @var iterable
     */
    private $players;

    /**
     * @Groups({"get"})
     * @var DiceType
     */
    private $diceType;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param mixed $players
     */
    public function setPlayers($players): void
    {
        $this->players = $players;
    }

    /**
     * @return mixed
     */
    public function getDiceType(): ?DiceType
    {
        return $this->diceType;
    }

    /**
     * @param DiceType $diceType
     */
    public function setDiceType(DiceType $diceType): void
    {
        $this->diceType = $diceType;
    }
}