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
 *              "normalization_context"={"groups"={"get_player"}},
 *              "denormalization_context"={"groups"={"post"}}
 *      },
 *     "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *      }
 *     },
 *     itemOperations={
 *          "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get_player"}}
 *          },
 *          "put"={
 *              "method"="PUT",
 *              "normalization_context"={"groups"={"get_player"}},
 *              "denormalization_context"={"groups"={"put"}}
 *          },
 *          "put_in_use"={
 *              "method"="PUT",
 *              "path"="/players/in_use/{id}",
 *              "normalization_context"={"groups"={"get_player"}},
 *              "denormalization_context"={"groups"={"put_in_use"}}
 *          }
 *     }
 * )
 * )
 */
class Player
{

    /**
     * @Groups({"get_player", "get", "get_list"})
     * @var int
     */
    private $id;

    /**
     * @Groups({"post", "get_player", "get", "get_list"})
     * @var string
     */
    private $name;

    /**
     * @Groups({"get_player", "put", "get", "get_list"})
     * @var int
     */
    private $level;

    /**
     * @Groups({"get_player", "put", "get"})
     * @var int
     */
    private $experience;

    /**
     * @Groups({"get_player", "put", "get"})
     * @var int
     */
    private $life;

    /**
     * @Groups({"get_player", "put", "get"})
     * @var int
     */
    private $maneuverability;

    /**
     * @Groups({"get_player", "put", "get"})
     * @var int
     */
    private $attackPower;

    /**
     * @Groups({"get_player", "put", "get"})
     * @var int
     */
    private $defense;

    /**
     * @Groups({"get_player", "put", "get"})
     * @var int
     */
    private $parade;

    /**
     * @Groups({"get_player", "put", "get"})
     * @var int
     */
    private $gold;

    /**
     * @Groups({"post", "get", "put", "get", "get_list"})
     * @var string
     */
    private $picture;

    /**
     * @Groups({"get_player"})
     * @var string
     */
    private $token;
    /**
     * @Groups({"post", "get_player", "get"})
     * @var Game
     */
    private $game;

    /**
     * @Groups({"post", "get_player", "get"})
     * @var Game
     */
    private $gameMaster;

    /**
     * @Groups({"get_player", "put", "get", "put_in_use", "get_list"})
     * @var bool
     */
    private $inUse = true;

    /**
     * @Groups({"post", "get_player", "put", "get", "get_list"})
     */
    private $race;

    /**
     * @Groups({"post", "get_player", "put", "get", "get_list"})
     */
    private $job;

    /**
     * @Groups({"post", "get_player", "put", "get", "get_list"})
     */
    private $gender;

    /**
     * @Groups({"post", "get_player", "put", "get", "get_list"})
     */
    private $group;

    /**
     * @Groups({"get_player", "put", "get"})
     */
    private $objectItems;

    /**
     * Player constructor.
     */
    public function __construct()
    {
        $this->setToken();
    }

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
    public function getLevel(): ?int
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
    public function getExperience(): ?int
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
    public function getLife(): ?int
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
    public function getManeuverability(): ?int
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
    public function getAttackPower(): ?int
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
    public function getDefense(): ?int
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
    public function getParade(): ?int
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
    public function getGold(): ?int
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
    public function getPicture(): ?string
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
     * @return Game
     */
    public function getGameMaster(): ?Game
    {
        return $this->gameMaster;
    }

    /**
     * @param Game $gameMaster
     */
    public function setGameMaster(Game $gameMaster): void
    {
        $this->gameMaster = $gameMaster;
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

    /**
     * @return Game
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * @param Game $game
     */
    public function setGame(Game $game): void
    {
        $this->game = $game;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     *
     */
    public function setToken(): void
    {
        $this->token = mt_rand();
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group): void
    {
        $this->group = $group;
    }
}