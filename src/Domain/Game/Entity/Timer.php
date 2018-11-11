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
 *     collectionOperations={},
 *     itemOperations={
 *          "get"={"method"="GET"}
 *     }
 * )
 * )
 */
class Timer
{
    /**
     * @var int
     */
    private $id;
    /**
     * @Groups({"get"})
     * @var \DateTime
     */
    private $startDate;
    /**
     * @Groups({"get"})
     * @var \DateTime
     */
    private $endDate;
    /**
     * @Groups({"get"})
     * @var Game
     */
    private $game;

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
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
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

}