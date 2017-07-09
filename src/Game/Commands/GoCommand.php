<?php

namespace BinaryStudioAcademy\Game\Commands;

class GoCommand extends Command
{
    protected $msgTemplate = "You're at {room}. You can go to: {rooms_avail}.";

    public function execute($params = null)
    {
        $room = $params[0] ?? '';
        $room = $this->game->player->goToNextRoom($params[0])->room;

        return $this->buildMessage([
            'room' => $room->name,
            'rooms_avail' => $room->getAvailableRooms(),
        ]);
    }
}
