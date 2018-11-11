<?php

namespace App\Api\Player\Event;


use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Domain\Dice\Entity\Dice;
use App\Domain\Dice\Entity\Roll;
use App\Domain\Player\Entity\Player;
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
     * AllowUserEvent constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
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

        if (!$player instanceof Player || Request::METHOD_PUT !== $method || $this->requestStack->getCurrentRequest()->get('__route') === "")  {
            return;
        }

        // check that the user that do the modif is the master player
        $token = $this->requestStack->getCurrentRequest()->headers->get('Player User');

        $masterPlayerToken = $player->getGame()->getMasterPlayer()->getToken();

        if ($token !== $masterPlayerToken) {
            throw new UnsupportedUserException('Not allowed');
        }

    }
}