<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 11/11/2018
 * Time: 23:33
 */

namespace App\Controller;


use App\Api\User\Security\AuthorizeUser;
use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\PropertyAccess\Exception\InvalidPropertyPathException;

/**
 * Class GameMasterController
 *
 * @package App\Controller
 */
class GameMasterController extends Controller
{
    /**
     * @var AuthorizeUser
     */
    private $authorizeUser;

    /**
     *
     */
    public function __construct(AuthorizeUser $authorizeUser)
    {
        $this->authorizeUser = $authorizeUser;
    }

    /**
     * @param Game   $data
     * @param string $status
     *
     * @return Game
     */
    public function __invoke(Game $data): Game
    {
        // Only the game master can start or end a fame
        $this->authorizeUser->isAuthorized($data);

        return $data;
    }
}