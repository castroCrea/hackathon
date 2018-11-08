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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class PlayerValidatorConstraint extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function validate($value, Constraint $constraint): void
    {
        /** @var Player $player */
        $player = $this->context->getObject();


        $player = $this->entityManager->getRepository(Player::class)->findBy(['game' => $player->getGame(), 'inUse' => true]);
        $gameMaster = $this->entityManager->getRepository(Player::class)->findOneBy(['gameMaster' => $player->getGame(), 'inUse' => true]);

        if (count($player) > $player->getGame()->getMaxPlayer()) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }

        if (null !== $gameMaster && null !== $player->getGameMaster()) {
            $this->context->buildViolation($constraint->messageMaster)->addViolation();
        }
    }

}