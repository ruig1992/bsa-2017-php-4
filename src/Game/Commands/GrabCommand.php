<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Game;
use BinaryStudioAcademy\Game\Exceptions\GameVictory;

class GrabCommand extends Command
{
    public function execute($params = null)
    {
        $playerCoins = $this->game->player->grabCoin()->coins;

        if ($playerCoins === Game::COINS_TO_WIN) {
            CommandManager::isFinished(true);
            return "Good job. You've completed this quest. Bye!";
        }
        return "Congrats! Coin has been added to inventory.";
    }
}
