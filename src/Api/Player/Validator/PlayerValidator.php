<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 23:23
 */

namespace App\Api\Player\Validator;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class PlayerValidator extends Constraint
{
    public $message = 'max user';
    public $messageMaster = 'already a game master';

    /**
     * @return array|string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}