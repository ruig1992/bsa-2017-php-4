<?php

namespace BinaryStudioAcademy\Game\Commands;

class ObserveCommand extends Command
{
    protected $msgTemplate = "There {coins} coin(s) here.";

    public function execute($params = null)
    {
        return $this->buildMessage([
            'coins' => $this->game->player->room->coins,
        ]);
    }
}
