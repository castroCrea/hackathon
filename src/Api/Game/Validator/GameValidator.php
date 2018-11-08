<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 23:23
 */

namespace App\Api\Game\Validator;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class GameValidator extends Constraint
{
    public $message = 'min 3 user';

    /**
     * @return array|string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}