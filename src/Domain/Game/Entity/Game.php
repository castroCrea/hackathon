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


}