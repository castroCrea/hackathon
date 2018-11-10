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
     * PlayerConstraintValidator constructor.
     *
     * @param PlayerRepository $playerRepository
     */
    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }


    /**
     * @param mixed      $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var Player $player */
        $player = $this->context->getObject();
        // All Players in the game exclude GameMaster
        $players = $this->playerRepository->findAllGamersByGame($player->getGame(), true);
        // Only the game master
        $gameMaster = $this->playerRepository->findOneBy(['gameMaster' => $player->getGame(), 'inUse' => true]);
        //Check that there is not another user ni the game with the same user
        $playerWithSameName = $this->playerRepository->findOneBy(['game' => $player->getGame(), 'name' => $player->getName()]);
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