<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 21:51
 */

namespace App\Domain\Game\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Player\Entity\Player;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
*
* @ORM\Entity
*
* @ApiResource(
*     collectionOperations={"post"={
*              "method"="POST",
*              "normalization_context"={"groups"={"get"}},
*              "denormalization_context"={"groups"={"post"}}
*      }},
*     itemOperations={"get"={"method"="GET"}}
* )
*/
class Game
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @Groups({"post", "get"})
     * @var string
     */
    protected $title;

    /**
     * @Groups({"post", "get"})
     * @var string
     */
    protected $description;

    /**
     * @Groups({"get"})
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @Groups({"post", "get"})
     * @var int
     */
    protected $maxPlayer;

    /**
     * @var PersistentCollection
     */
    protected $players;

    /**
     * @var Player
     */
    protected $masterGame;

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
    public function getPlayers(): PersistentCollection
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
    public function getMasterGame(): Player
    {
        return $this->masterGame;
    }

    /**
     * @param Player $masterGame
     */
    public function setMasterGame(Player $masterGame): void
    {
        $this->masterGame = $masterGame;
    }

}