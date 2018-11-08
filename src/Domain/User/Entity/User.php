<?php

namespace App\Domain\User\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;

/**
 * @ORM\Entity
 *
 * @ApiResource(
 *     collectionOperations={"post"={
 *              "method"="POST",
 *              "normalization_context"={"groups"={"post"}},
 *              "denormalization_context"={"groups"={"post"}}
 *      }},
 *     itemOperations={"get"={"method"="GET"}}
 * )
 */
class User extends BaseUser
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @Groups({"post"})
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $fullname;

    /**
     * @Groups({"post"})
     * @var string
     */
    protected $plainPassword;

    /**
     * @var string
     */
    protected $username;

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }
    public function getFullname()
    {
        return $this->fullname;
    }

    public function isUser(UserInterface $user = null)
    {
        return $user instanceof self && $user->id === $this->id;
    }
}