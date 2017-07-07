<?php

namespace BinaryStudioAcademy\Game\Rooms;

use BinaryStudioAcademy\Game\Contracts\Room;
use BinaryStudioAcademy\Game\Exceptions\RoomNotFound;

class RoomFactory
{
    /**
     * Create the new Room by the name
     * @param  string $name
     * @return Room
     */
    public static function create(string $name): Room
    {
        $name = ucfirst(trim($name));
        return self::isRoomExists($name);
    }
    /**
     * Checks if there is a room with the name
     * @param  string  $name
     * @return Room
     * @throws RoomNotFound Exception
     */
    protected static function isRoomExists(string $name): Room
    {
        $room = '\\' . __NAMESPACE__ . '\\' . $name;
        if (!class_exists($room) ||
            !(($room = new $room($name)) instanceof Room)
        ) {
            throw new RoomNotFound($name);
        }
        return $room;
    }
}
