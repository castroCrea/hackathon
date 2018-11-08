<?php

namespace App\Domain\Gender\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
class Gender
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
     * @ORM\OneToMany(targetEntity="App\Domain\Player\Entity\Player", mappedBy="gender")
     */
    private $players;

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


}
