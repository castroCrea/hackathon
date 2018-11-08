<?php

namespace App\Domain\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use App\Api\User\Validator\Constraints\UserProperties;

/**
 * @ORM\Entity
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
     * @UserProperties
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