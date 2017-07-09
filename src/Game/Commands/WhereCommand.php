<?php

namespace BinaryStudioAcademy\Game\Commands;

class WhereCommand extends Command
{
    /**
     * Message template
     * @var string
     */
    protected $msgTemplate = "You're at {room}. You can go to: {rooms_avail}.";

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        $room = $this->game->player->room;

        return $this->buildMessage([
            'room' => $room->name,
            'rooms_avail' => $room->getAvailableRooms(),
        ]);
    }
}
