<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 21:51
 */

namespace App\Entity;

use App\Entity\Player;
use Doctrine\ORM\PersistentCollection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;
use App\Api\Game\Validator\GameConstraint;
use App\Controller\GameStatusController;

/**
 * @ORM\Entity
 * @GameConstraint
 * @ApiResource(
 *     collectionOperations={"post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"post"}},
 *              "denormalization_context"={"groups"={"post"}}
 *      },
 *
 *     "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get_list"}},
 *              "filters"={"game.creationDate", "game.title", "game.isFinish"}
 *      }
 *     },
 *     itemOperations={
 *          "get"={"method"="GET"},
 *          "game_status"={
 *              "method"="PUT",
 *              "path"="/games/{status}/{id}",
 *              "controller"=GameStatusController::class,
 *              "denormalization_context"={"groups"={"game_status"}}
 *          }
 *     }
 * )
 * )
 */
//TODO : One request for the master game and on for players with description and descriptionMasterGame
class Game
{
    /**
     * @var int
     */
    private $id;

    /**
     * @Groups({"post", "get", "get_list"})
     * @var string
     */
    private $title;

    /**
     * @Groups({"post", "get", "get_list"})
     * @var string
     */
    private $description;

    /**
     * @Groups({"post", "get", "get_list"})
     * @var string
     */
    private $descriptionMasterGame;

    /**
     * @Groups({"get", "get_list"})
     * @var string
     */
    private $isFinish = false;

    /**
     * @Groups({"get", "get_list"})
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @Groups({"post", "get", "get_list"})
     * @var int
     */
    private $maxPlayer;

    /**
     * @Groups({"get", "get_list"})
     * @var iterable
     */
    private $players;

    /**
     * @Groups({"get", "get_list"})
     * @var Player
     */
    private $masterPlayer;
    /**
    * @Groups({"get", "get_list"})
    * @var Timer
    */
    private $timer;

    public function __construct()
    {
        $this->creationDate = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     * @return string
     */
    public function getDescriptionMasterGame(): string
    {
        return $this->descriptionMasterGame;
    }

    /**
     * @param string $descriptionMasterGame
     */
    public function setDescriptionMasterGame(string $descriptionMasterGame): void
    {
        $this->descriptionMasterGame = $descriptionMasterGame;
    }

    /**
     * @return int
     */
    public function getMaxPlayer(): int
    {
        return $this->maxPlayer;
    }

    /**
     * @param int $maxPlayer
     */
    public function setMaxPlayer(int $maxPlayer): void
    {
        $this->maxPlayer = $maxPlayer;
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

    /**
     * @return iterable
     */
    public function getPlayers(): ?iterable
    {
        return $this->players;
    }

    /**
     * @param PersistentCollection $players
     */
    public function setPlayers(PersistentCollection $players): void
    {
        $this->players = $players;
    }

    /**
     * @return Player
     */
    public function getMasterPlayer() : ?Player
    {
        return $this->masterPlayer;
    }

    /**
     * @param Player $masterPlayer
     */
    public function setMasterPlayer(Player $masterPlayer): void
    {
        $this->masterPlayer = $masterPlayer;
    }

    /**
     * @return Timer
     */
    public function getTimer(): ?iterable
    {
        return $this->timer;
    }

    /**
     * @param Timer $timer
     */
    public function setTimer(Timer $timer): void
    {
        $this->timer = $timer;
    }

    /**
     * @return string
     */
    public function getIsFinish(): string
    {
        return $this->isFinish;
    }

    /**
     * @param string $isFinish
     */
    public function setIsFinish(string $isFinish): void
    {
        $this->isFinish = $isFinish;
    }
}