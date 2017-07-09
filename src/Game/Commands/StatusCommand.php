<?php

namespace BinaryStudioAcademy\Game\Commands;

class StatusCommand extends Command
{
    /**
     * Message template
     * @var string
     */
    protected $msgTemplate = "You're at {room}. You have {coins} coins.";

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        $player = $this->game->player;

        return $this->buildMessage([
            'room' =>$player->room->name,
            'coins' => $player->coins,
        ]);
    }
}
