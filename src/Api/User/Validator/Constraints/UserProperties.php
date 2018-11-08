<?php
/**
 * Created by PhpStorm.
 * User: paolo
 * Date: 08/11/18
 * Time: 20:21
 */

namespace App\Api\User\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class UserProperties extends Constraint
{
    public $message = 'Username already used';

}