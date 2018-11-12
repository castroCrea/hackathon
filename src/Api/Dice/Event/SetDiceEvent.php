<?php

namespace App\Api\Dice\Event;


use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Domain\Dice\Entity\Dice;
use App\Domain\Dice\Entity\Roll;
use App\Domain\Game\Authorization\GameAuthorization;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PropertyAccess\Exception\InvalidPropertyPathException;

/**
 * Class SetDiceEvent
 *
 * @package App\Api\Dice\Event
 */
final class SetDiceEvent implements EventSubscriberInterface
{
    /**
     * @var IriConverterInterface
     */
    private $iriConverter;
    /**
     * @var GameAuthorization
     */
    private $gameAuthorization;

    /**
     * SetDiceEvent constructor.
     *
     * @param IriConverterInterface $iriConverter
     * @param GameAuthorization     $gameAuthorization
     */
    public function __construct(IriConverterInterface $iriConverter, GameAuthorization $gameAuthorization)
    {
        $this->iriConverter = $iriConverter;
        $this->gameAuthorization = $gameAuthorization;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setDice', EventPriorities::PRE_WRITE],
        ];
    }

    /**
     * set all dices value
     *
     * @param GetResponseForControllerResultEvent $event
     */
    public function setDice(GetResponseForControllerResultEvent $event)
    {
        $roll = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$roll instanceof Roll || Request::METHOD_POST !== $method) {
            return;
        }
        //Check if the game is Authorized
        if (!$this->gameAuthorization->gameMinimumToStart($roll->getPlayer()->getGame())) {
            throw new InvalidPropertyPathException();
        };

        /** @var Dice $dice */
        foreach ($roll->getDices() as $dice) {
            $dice->setValue(rand(1,$dice->getDiceType()->getValue()));
        }
    }
}