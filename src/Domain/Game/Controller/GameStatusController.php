<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 11/11/2018
 * Time: 23:33
 */

namespace App\Domain\Game\Controller;


use App\Domain\Game\Entity\Game;

class GameStatusController
{
    public function __invoke(Game $data): Game
    {

        return $data;
    }
}