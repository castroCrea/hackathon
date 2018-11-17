<?php
/**
 * Created by PhpStorm.
 * User: paolocastro
 * Date: 12/11/2018
 * Time: 21:44
 */

namespace App\Service\Game\Authorization;


use App\Entity\Game;
use App\Entity\Player;

/**
 * Class GameAuthorization
 *
 * @package App\Authorization
 */
class GameAuthorization
{
    /**
     * Find that the game is on -> it means that there is a master player and he is in use and there is a least 2 inUse player
     *
     * @param Game $game
     *
     * @return bool
     */
    public function gameMinimumToStart(Game $game) {
        // if there is a game master playing
        if ($game->getMasterPlayer() && $game->getMasterPlayer()->isInUse() && !$game->getIsFinish()) {
            $i = 0;
            /** @var Player $player */
            foreach ($game->getPlayers() as $player) {
                // if user is in use we add one
                $i += ($player->isInUse()) ? 1 : 0;
            }
            if ($i > 1) {
                return true;
            }
        }
        return false;
    }
}