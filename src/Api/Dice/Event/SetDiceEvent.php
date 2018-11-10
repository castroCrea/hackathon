<?php

namespace App\Api\Dice\Event;


use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Domain\Dice\Entity\Dice;
use App\Domain\Dice\Entity\Roll;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

final class SetDiceEvent implements EventSubscriberInterface
{
    private $iriConverter;

    public function __construct(IriConverterInterface $iriConverter)
    {
        $this->iriConverter = $iriConverter;
    }

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

        /** @var Dice $dice */
        foreach ($roll->getDices() as $dice) {
            $dice->setValue(rand(1,$dice->getDiceType()->getValue()));
        }
    }
}