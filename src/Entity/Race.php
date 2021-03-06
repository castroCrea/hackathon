<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"get"}}
 *      }
 *     },
 *     itemOperations={"get"={"method"="GET"}}
 * )
 * )
 */
class Race
{
    /**
     * @var int
     */
    private $id;

    /**
     * @Groups({"get", "get_list"})
     * @var string
     */
    private $name;

    /**
     * @Groups({"get"})
     * @var int
     */
    private $coeff;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="race")
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
     * @return int
     */
    public function getCoeff(): ?int
    {
        return $this->coeff;
    }

    /**
     * @param int $coeff
     */
    public function setCoeff(int $coeff): void
    {
        $this->coeff = $coeff;
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