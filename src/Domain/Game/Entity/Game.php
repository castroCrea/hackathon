<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 21:51
 */

namespace App\Domain\Game\Entity;

use App\Domain\Player\Entity\Player;
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
 *              "normalization_context"={"groups"={"get"}},
 *              "filters"={"game.creationDate", "game.title"}
 *      }
 *     },
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * )
 */
class Game
{
    /**
     * @var int
     */
    private $id;

    /**
     * @Groups({"post", "get"})
     * @var string
     */
    private $title;

    /**
     * @Groups({"post", "get"})
     * @var string
     */
    private $description;

    /**
     * @Groups({"get"})
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @Groups({"post", "get"})
     * @var int
     */
    private $maxPlayer;

    /**
     * @Groups({"get"})
     * @var PersistentCollection
     */
    private $players;

    /**
     * @Groups({"get"})
     * @var Player
     */
    private $masterPlayer;

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
     * @return PersistentCollection
     */
    public function getPlayers(): ?PersistentCollection
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
    public function getMasterPlayer(): Player
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

}