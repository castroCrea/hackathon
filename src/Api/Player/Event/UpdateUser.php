<?php

namespace App\Api\Player\Event;


use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Domain\Dice\Entity\Dice;
use App\Domain\Dice\Entity\Roll;
use App\Domain\Player\Entity\Player;
use App\Repository\PlayerRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\UserNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

final class UpdateUser implements EventSubscriberInterface
{
    /** @var RequestStack  */
    private $requestStack;
    /**
     * @var PlayerRepository
     */
    private $playerRepository;

    /**
     * AllowUserEvent constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack, PlayerRepository $playerRepository)
    {
        $this->requestStack = $requestStack;
        $this->playerRepository = $playerRepository;
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
        /** @var Player $player */
        $player = $event->getControllerResult();


        if ($this->requestStack->getCurrentRequest()->get('_route') !== "api_players_put_in_use_item")  {
            return;
        }
        $player->setToken();
        $this->playerRepository->save($player);
    }
}