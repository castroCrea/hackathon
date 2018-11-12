<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 23:23
 */

namespace App\Api\Player\Validator;


use App\Domain\Game\Entity\Game;
use App\Domain\Player\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class PlayerConstraintValidator
 *
 * @package App\Api\Player\Validator
 */
final class PlayerConstraintValidator extends ConstraintValidator
{
    /**
     * @var PlayerRepository
     */
    private $playerRepository;
    /**
     * @var RequestStack
     */
    private $request;

    /**
     * PlayerConstraintValidator constructor.
     *
     * @param PlayerRepository $playerRepository
     */
    public function __construct(PlayerRepository $playerRepository, RequestStack $request)
    {
        $this->playerRepository = $playerRepository;
        $this->request = $request;
    }


    /**
     * @param mixed      $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {

        if ($this->request->getCurrentRequest()->getMethod() === "POST") {
            /** @var Player $player */
            $player = $this->context->getObject();
            $game = null;

            //get Game
            if ($player->getGame()) {
                $game = $player->getGame();
            } elseif ( ($player->getGameMaster())) {
                $game = $player->getGameMaster();
            } else {
                $this->context->buildViolation($constraint->message)->addViolation();
            }

            if ($game) {
                // All Players in the game exclude GameMaster
                $players = $this->playerRepository->findAllGamersByGame($game, true);
                // Only the game master
                $gameMaster = $this->playerRepository->findOneBy(['gameMaster' => $game, 'inUse' => true]);
                //Check that there is not another user ni the game with the same user
                $playerWithSameName = $this->playerRepository->findOneBy(['game' => $game, 'name' => $game]);
                //Check that there is not too much player in the game
                if (count($players) >= $player->getGame()->getMaxPlayer()) {
                    $this->context->buildViolation($constraint->message)->addViolation();
                }
                // check that there is not a game master in use
                if (null !== $gameMaster && null !== $player->getGameMaster()) {
                    $this->context->buildViolation($constraint->messageMaster)->addViolation();
                }
                // check that there is not a game master in use
                if (null === $player->getGame() && null === $player->getGameMaster()) {
                    $this->context->buildViolation($constraint->cannotBeNull)->addViolation();
                }
                // check that there is not a user with the same name in the game
                if ($playerWithSameName) {
                    $this->context->buildViolation($constraint->sameName)->addViolation();
                }
            }
        }
    }
}