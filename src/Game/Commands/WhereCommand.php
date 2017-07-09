<?php

namespace BinaryStudioAcademy\Game\Commands;

class WhereCommand extends Command
{
    protected $msgTemplate = "You're at {room}. You can go to: {rooms_avail}.";

    public function execute($params = null)
    {
        $room = $this->game->player->room;

        return $this->buildMessage([
            'room' => $room->name,
            'rooms_avail' => $room->getAvailableRooms(),
        ]);
    }
}
