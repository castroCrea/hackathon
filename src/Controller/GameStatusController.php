<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 11/11/2018
 * Time: 23:33
 */

namespace App\Controller;


use App\Api\User\Security\AuthorizeUser;
use App\Service\Game\Authorization\GameAuthorization;
use App\Entity\Game;
use App\Entity\Timer;
use App\Repository\GameRepository;
use App\Repository\TimerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\PropertyAccess\Exception\InvalidPropertyPathException;

/**
 * Class GameStatusController
 *
 * @package App\Controller
 */
class GameStatusController extends Controller
{
    /**
     * @var GameAuthorization
     */
    private $gameAuthorization;
    /**
     * @var TimerRepository
     */
    private $timerRepository;
    /**
     * @var AuthorizeUser
     */
    private $authorizeUser;
    /**
     * @var GameRepository
     */
    private $gameRepository;
    /**
     * @var array
     */
    private $statusAllow = [
        'start' => true,
        'end' => true,
        'finish' => true
    ];

    /**
     * GameStatusController constructor.
     *
     * @param GameAuthorization $gameAuthorization
     * @param TimerRepository   $timerRepository
     * @param AuthorizeUser     $authorizeUser
     * @param GameRepository    $gameRepository
     */
    public function __construct(GameAuthorization $gameAuthorization, TimerRepository $timerRepository, AuthorizeUser $authorizeUser, GameRepository $gameRepository)
    {
        $this->gameAuthorization = $gameAuthorization;
        $this->timerRepository = $timerRepository;
        $this->authorizeUser = $authorizeUser;
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param Game   $data
     * @param string $status
     *
     * @return Game
     */
    public function __invoke(Game $data, string $status): Game
    {
        // if minimum start is true and status is allowed
        if (!$this->gameAuthorization->gameMinimumToStart($data) && isset($this->statusAllow[$status])) {
            throw new InvalidPropertyPathException();
        }

        // Only the game master can start or end a fame
        $this->authorizeUser->isAuthorized($data);

        /** @var Timer $timer -> get the */
        $timer = $this->timerRepository->findOneBy(['game' => $data, 'endDate' => null]);

        // create or update timer
        if ('start' === $status && null === $timer) {
            $timer = new Timer();
            $timer->setStartDate(new \DateTime());
            $timer->setGame($data);
            $this->timerRepository->save($timer);
        } elseif ('end' === $status && $timer) {
            $timer->setEndDate(new \DateTime());
            $this->timerRepository->save($timer);
        } elseif ('finish' === $status) {
            // we finish the game
            if ($timer) {
                $timer->setEndDate(new \DateTime());
                $this->timerRepository->save($timer);
            }
            $data->setIsFinish(true);
            $this->gameRepository->save($data);
        } else {
            throw new InvalidPropertyPathException();
        }

        return $data;
    }
}