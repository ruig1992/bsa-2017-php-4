<?php

namespace BinaryStudioAcademy\Game\Factories;

use BinaryStudioAcademy\Game\Contracts\Room;
use BinaryStudioAcademy\Game\Exceptions\RoomNotFound;

class RoomFactory
{
    /**
     * Create the new Room by the name
     * @param string $name
     * @return Room
     */
    public static function create(string $name): Room
    {
        $name = ucfirst(trim($name));
        $room = self::isRoomExists($name);
        return $room;
    }
    /**
     * Checks if there is the room with the name
     * @param  string  $name
     * @return Room
     * @throws RoomNotFound Exception
     */
    protected static function isRoomExists(string $name): Room
    {
        $room = "\BinaryStudioAcademy\Game\Rooms\\{$name}";
        if (!class_exists($room) ||
            !(($room = new $room) instanceof Room)
        ) {
            throw new RoomNotFound($name);
        }
        return $room;
    }
}
