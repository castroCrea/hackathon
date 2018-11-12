<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 12/11/2018
 * Time: 21:44
 */

namespace App\Domain\Game\Authorization;


use App\Domain\Game\Entity\Game;
use App\Domain\Player\Entity\Player;

class GameAuthorization
{
    public function gameIsOn(Game $game) {
        // if there is a game master playing
        if ($game->getMasterPlayer()->isInUse()) {
            $i = 0;
            /** @var Player $player */
            foreach ($game->getPlayers() as $player) {
                // if user is in use we add one
                $i += ($player->isInUse()) ? 1 : 0;
            }
        }
    }
}