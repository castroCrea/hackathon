<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 23:23
 */

namespace App\Api\Game\Validator;


use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class GameConstraintValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function validate($value, Constraint $constraint): void
    {
        /** @var GameConstraint $game */
        $game = $this->context->getObject();

        if ($game->getMaxPlayer() < 3) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }

}