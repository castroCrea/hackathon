<?php

namespace App\Api\User\Event;


use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Domain\Game\Entity\Game;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

final class AllowUser implements EventSubscriberInterface
{
    private $iriConverter;

    public function __construct(IriConverterInterface $iriConverter)
    {
        $this->iriConverter = $iriConverter;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['allow', EventPriorities::POST_WRITE],
        ];
    }

    public function allow(GetResponseForControllerResultEvent $event)
    {
        $game = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$game instanceof Game || Request::METHOD_PUT !== $method) {
            return;
        }

        $userIRI = $event->getRequest()->headers->get('user');

        $user = $this->iriConverter->getItemFromIri($userIRI);

        if ($game->getMasterGame() !== $user) {
            throw new NotFoundResourceException();
        }

    }
}