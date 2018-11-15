<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 12/11/2018
 * Time: 22:39
 */

namespace App\Api\User\Security;


use App\Entity\Game;
use App\Repository\PlayerRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class AuthorizeUser
 *
 * @package App\Api\User\Security
 */
class AuthorizeUser
{
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var PlayerRepository
     */
    private $playerRepository;

    /**
     * AuthorizeUser constructor.
     *
     * @param RequestStack     $requestStack
     * @param PlayerRepository $playerRepository
     */
    public function __construct(RequestStack $requestStack, PlayerRepository $playerRepository)
    {
        $this->requestStack = $requestStack;
        $this->playerRepository = $playerRepository;
    }

    /**
     * @param Game $game
     */
    public function isAuthorized(Game $game){
        // get player from token
        $token = $this->requestStack->getCurrentRequest()->headers->get('Authorization');
        $player = $this->playerRepository->findOneBy(['token' => $token]);

        if (null === $player || $game->getMasterPlayer() !== $player) {
            throw new NotFoundResourceException();
        }
    }
}