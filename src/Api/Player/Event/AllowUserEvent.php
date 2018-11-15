<?php

namespace App\Api\Player\Event;


use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Api\User\Security\AuthorizeUser;
use App\Entity\Dice;
use App\Entity\Roll;
use App\Service\Game\Authorization\GameAuthorization;
use App\Entity\Player;
use App\Repository\PlayerRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\UserNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

final class AllowUserEvent implements EventSubscriberInterface
{
    /** @var RequestStack  */
    private $requestStack;
    /**
     * @var AuthorizeUser
     */
    private $authorizeUser;
    /**
     * @var GameAuthorization
     */
    private $gameAuthorization;

    /**
     * AllowUserEvent constructor.
     *
     * @param RequestStack      $requestStack
     * @param AuthorizeUser     $authorizeUser
     * @param GameAuthorization $gameAuthorization
     */
    public function __construct(RequestStack $requestStack, AuthorizeUser $authorizeUser, GameAuthorization
    $gameAuthorization)
    {
        $this->requestStack = $requestStack;
        $this->authorizeUser = $authorizeUser;
        $this->gameAuthorization = $gameAuthorization;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['allowUser', EventPriorities::PRE_VALIDATE],
        ];
    }

    /**
     * set all dices value
     *
     * @param GetResponseForControllerResultEvent $event
     */
    public function allowUser(GetResponseForControllerResultEvent $event)
    {
        $player = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$player instanceof Player || Request::METHOD_PUT !== $method || $this->requestStack->getCurrentRequest()->get('_route') === "api_players_put_in_use_item")  {
            return;
        }
        // check if the user is authorized for this request
        $this->authorizeUser->isAuthorized($player->getGame());
        // if the game is not of to be able throw exception
        if (!$this->gameAuthorization->gameMinimumToStart($player->getGame())) {
            throw new NotFoundResourceException();
        }


    }
}