<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Game;
use App\Entity\Race;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Api\Player\Validator\PlayerConstraint;

/**
 * @ORM\Entity
 * @PlayerConstraint
 * @ApiResource(
 *     collectionOperations={
 *     "post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"get"}},
 *              "denormalization_context"={"groups"={"post_monster"}}
 *      },
 *     "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *      }
 *     },
 *     itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *          },
 *          "put"={
 *              "method"="PUT",
 *              "normalization_context"={"groups"={"get"}},
 *              "denormalization_context"={"groups"={"put_monster"}}
 *          }
 *     }
 * )
 * )
 */
class Monster
{

    /**
     * @Groups({ "get"})
     * @var int
     */
    private $id;

    /**
     * @Groups({"post_monster",  "get"})
     * @var string
     */
    private $name;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $level;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $experience;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $life;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $maneuverability;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $attackPower;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $defense;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $parade;

    /**
     * @Groups({ "put_monster", "get"})
     * @var int
     */
    private $gold;

    /**
     * @Groups({"post_monster", "get", "put_monster", "get"})
     * @var string
     */
    private $picture;

    /**
     * @Groups({"post_monster",  "put_monster", "get"})
     */
    private $race;

    /**
     * @Groups({"post_monster",  "put_monster", "get"})
     */
    private $job;

    /**
     * @Groups({"post_monster",  "put_monster", "get"})
     */
    private $gender;
    /**
     * @Groups({"post_monster",  "put_monster", "get"})
     */
    private $objectItems;
    /**
     * @Groups({"post_monster",  "put_monster", "get"})
     * @var bool
     */
    private $isDead = false;
    /**
     * @Groups({"post_monster",  "put_monster", "get"})
     * @var bool
     */
    private $isOut = false;

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
     * @return int
     */
    public function getExperience(): int
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     */
    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
    }

    /**
     * @return int
     */
    public function getLife(): int
    {
        return $this->life;
    }

    /**
     * @param int $life
     */
    public function setLife(int $life): void
    {
        $this->life = $life;
    }

    /**
     * @return int
     */
    public function getManeuverability(): int
    {
        return $this->maneuverability;
    }

    /**
     * @param int $maneuverability
     */
    public function setManeuverability(int $maneuverability): void
    {
        $this->maneuverability = $maneuverability;
    }

    /**
     * @return int
     */
    public function getAttackPower(): int
    {
        return $this->attackPower;
    }

    /**
     * @param int $attackPower
     */
    public function setAttackPower(int $attackPower): void
    {
        $this->attackPower = $attackPower;
    }

    /**
     * @return int
     */
    public function getDefense(): int
    {
        return $this->defense;
    }

    /**
     * @param int $defense
     */
    public function setDefense(int $defense): void
    {
        $this->defense = $defense;
    }

    /**
     * @return int
     */
    public function getParade(): int
    {
        return $this->parade;
    }

    /**
     * @param int $parade
     */
    public function setParade(int $parade): void
    {
        $this->parade = $parade;
    }

    /**
     * @return int
     */
    public function getGold(): int
    {
        return $this->gold;
    }

    /**
     * @param int $gold
     */
    public function setGold(int $gold): void
    {
        $this->gold = $gold;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race): void
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @param mixed $job
     */
    public function setJob($job): void
    {
        $this->job = $job;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getObjectItems()
    {
        return $this->objectItems;
    }

    /**
     * @param mixed $objectItems
     */
    public function setObjectItems($objectItems): void
    {
        $this->objectItems = $objectItems;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->isDead;
    }

    /**
     * @param bool $isDead
     */
    public function setIsDead(bool $isDead): void
    {
        $this->isDead = $isDead;
    }

    /**
     * @return bool
     */
    public function isOut(): bool
    {
        return $this->isOut;
    }

    /**
     * @param bool $isOut
     */
    public function setIsOut(bool $isOut): void
    {
        $this->isOut = $isOut;
    }
}