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
 *     collectionOperations={
 *     "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *      }
 *     },
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * )
 */
class Dice
{
    /**
     * @var int
     */
    private $id;

    /**
     * @Groups({"get"})
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @Groups({"post", "get"})
     * @var DiceType
     */
    private $diceType;

    /**
     * @var int
     */
    private $value;

    /**
     * Dice constructor.
     */
    public function __construct()
    {
        $this->creationDate = new \DateTime();
        $this->setValue();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * @return DiceType
     */
    public function getDiceType(): DiceType
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

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     *
     */
    public function setValue(): void
    {
        $this->value = rand(1, $this->diceType->getValue());
    }


}
