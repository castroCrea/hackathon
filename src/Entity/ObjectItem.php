<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\DiceType;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"get"}},
 *              "denormalization_context"={"groups"={"post_object"}}
 *      },
 *     "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *      }
 *     },
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * )
 */
class ObjectItem
{

    /**
     * @Groups({"get"})
     * @var int
     */
    private $id;

    /**
     * @Groups({"post_object", "get"})
     * @var string
     */
    private $name;

    /**
     * @Groups({"post_object", "get"})
     * @var string
     */
    private $description;

    /**
     * @Groups({"post_object", "get"})
     * @var int
     */
    private $value;

    /**
     * @var iterable
     */
    private $players;

    /**
     * @Groups({"post_object", "get"})
     * @var ObjectType
     */
    private $objectType;
    /**
     * @Groups({"post_object", "get"})
     * @var BodyPart
     */
    private $bodyPart;

    /**
     * @Groups({"post_object", "get"})
     * @var array
     */
    private $diceTypes = [];

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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
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
    public function getDiceTypes(): ?iterable
    {
        return $this->diceTypes;
    }

    /**
     * @param iterable|null $diceTypes
     */
    public function setDiceTypes(?iterable $diceTypes): void
    {
        $this->diceTypes = $diceTypes;
    }

    /**
     * @param DiceType $diceType
     */
    public function addDiceType(DiceType $diceType): void
    {
        $this->diceTypes[] = $diceType;
    }

    /**
     * @return ObjectType
     */
    public function getObjectType(): ObjectType
    {
        return $this->objectType;
    }

    /**
     * @param ObjectType $objectType
     */
    public function setObjectType(ObjectType $objectType): void
    {
        $this->objectType = $objectType;
    }

    /**
     * @return BodyPart
     */
    public function getBodyPart(): BodyPart
    {
        return $this->bodyPart;
    }

    /**
     * @param BodyPart $bodyPart
     */
    public function setBodyPart(BodyPart $bodyPart): void
    {
        $this->bodyPart = $bodyPart;
    }
}