<?php

namespace BinaryStudioAcademy\Game\Rooms;

use BinaryStudioAcademy\Game\Contracts\Room;
use BinaryStudioAcademy\Game\Exceptions\RoomNotFound;

class RoomFactory
{
    /**
     * Create the new Room with the $data
     * @param  array $data
     * @return Room
     */
    public static function create(array $data): Room
    {
        $name = trim($data[1]);
        $room = self::isRoomExists($name);

        $room->setup($data);

        return $room;
    }
    /**
     * Checks if there is a room with the name
     * @param  string  $name
     * @return Room
     * @throws RoomNotFound Exception
     */
    protected static function isRoomExists(string $name): Room
    {
        $room = '\\' . __NAMESPACE__ . '\\' . ucfirst($name);
        if (!class_exists($room) ||
            !(($room = new $room($name)) instanceof Room)
        ) {
            throw new RoomNotFound($name);
        }
        return $room;
    }
}
