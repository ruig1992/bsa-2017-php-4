<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Game;

class GrabCommand extends Command
{
    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        $playerCoins = $this->game->player->grabCoin()->coins;

        if ($playerCoins === Game::COINS_TO_WIN) {
            CommandManager::isFinished(true);
            return "Good job. You've completed this quest. Bye!";
        }
        return "Congrats! Coin has been added to inventory.";
    }
}
