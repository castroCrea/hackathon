<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 20:14
 */

namespace App\Api\User\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Domain\User\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;

class UserSubscriber implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(GetResponseForControllerResultEvent $event)
    {
        $book = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$book instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        $message = (new \Swift_Message('A new book has been added'))
            ->setFrom('system@example.com')
            ->setTo('contact@les-tilleuls.coop')
            ->setBody(sprintf('The book #%d has been added.', $book->getId()));

        $this->mailer->send($message);
    }
}