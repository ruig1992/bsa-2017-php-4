<?php

namespace BinaryStudioAcademy\Game\Commands;

class StatusCommand extends Command
{
    protected $msgTemplate = "You're at {room}. You have {coins} coins.";

    public function execute($params = null)
    {
        $player = $this->game->player;

        return $this->buildMessage([
            'room' =>$player->room->name,
            'coins' => $player->coins,
        ]);
    }
}
