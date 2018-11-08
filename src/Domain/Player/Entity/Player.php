<?php

namespace App\Domain\Player\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Race\Entity\Race;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"post"}},
 *              "denormalization_context"={"groups"={"post"}}
 *      },
 *
 *     "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *      }
 *     },
 *     itemOperations={"get"={"method"="GET"}}
 * )  itemOperations={"get"}
 * )
 */
class Player
{

    /**
     * @var int
     */
    private $id;

    /**
     * @Groups({"post", "get"})
     * @var string
     */
    private $name;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $level;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $experience;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $life;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $maneuverability;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $attackPower;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $defense;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $parade;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $gold;

    /**
     * @Groups({"post", "get"})
     * @var string
     */
    private $picture;

    /**
     * @Groups({"get"})
     * @var bool
     */
    private $inUse;

    /**
     * @Groups({"post", "get"})
     * @ORM\ManyToOne(targetEntity="App\Domain\Race\Entity\Race", inversedBy="players")
     */
    private $race;

    /**
     * @Groups({"post", "get"})
     * @ORM\ManyToOne(targetEntity="App\Domain\Job\Entity\Job", inversedBy="players")
     */
    private $job;

    /**
     * @Groups({"post", "get"})
     * @ORM\ManyToOne(targetEntity="App\Domain\Gender\Entity\Gender", inversedBy="players")
     */
    private $gender;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Protection\Entity\Protection", cascade={"persist"})
     */
    private $protections;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Weapon\Entity\Weapon", cascade={"persist"})
     */
    private $weapons;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\ObjectItem\Entity\ObjectItem", cascade={"persist"})
     */
    private $objectItems;

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
     * @return bool
     */
    public function isInUse(): bool
    {
        return $this->inUse;
    }

    /**
     * @param bool $inUse
     */
    public function setInUse(bool $inUse): void
    {
        $this->inUse = $inUse;
    }

    /**
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param Race $race
     */
    public function setRace(Race $race): void
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getProtections()
    {
        return $this->protections;
    }

    /**
     * @param mixed $protections
     */
    public function setProtections($protections): void
    {
        $this->protections = $protections;
    }

    /**
     * @return mixed
     */
    public function getWeapons()
    {
        return $this->weapons;
    }

    /**
     * @param mixed $weapons
     */
    public function setWeapons($weapons): void
    {
        $this->weapons = $weapons;
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

}