<?php

namespace BinaryStudioAcademy\Game\Rooms;

use BinaryStudioAcademy\Game\Contracts\Room;
use BinaryStudioAcademy\Game\Contracts\Thing;
use BinaryStudioAcademy\Game\Exceptions\RoomNotAvailable;
use BinaryStudioAcademy\Game\Exceptions\ThingNotFound;

abstract class AbstractRoom implements Room
{
    /**
     * Room name
     * @var string
     */
    protected $name;
    /**
     * Room things
     * @var array
     */
    protected $things = [];
    /**
     * List of rooms available from the current one
     * @var array
     */
    protected $availableRooms = [];

    public function __construct()
    {
        $this->name = strtolower(
            str_replace(__NAMESPACE__ . "\\", '', get_called_class())
        );
    }

    /**
     * PHP Magic Get
     * @param  string $property
     * @return mixed
     */
    public function __get(string $property)
    {
        // Get the room name
        if ($property === 'name') {
            return $this->name;
        }
        return null;
    }

    /**
     * Add new room that available for the current one
     * @param Room $room
     * @return $this
     */
    public function addAvailableRoom(Room $room): Room
    {
        $this->availableRooms[$room->name] = $room;
        return $this;
    }
    /**
     * Get the room, that available for the current one, by its name
     * @param  string $name
     * @return Room
     * @throws RoomNotAvailable Exception
     */
    public function getAvailableRoom(string $name): Room
    {
        if (!isset($this->availableRooms[$name])) {
            throw new RoomNotAvailable($name);
        }
        return $this->availableRooms[$name];
    }
    /**
     * Add the new thing for the current room
     * @param Thing $thing
     * @return $this
     */
    public function addThing(Thing $thing): Room
    {
        $this->things[$thing->name][] = $thing;
        return $this;
    }
    /**
     * Take the thing out of the current room by its name
     * @param string $name
     * @return Thing
     * @throws ThingNotFound Exception
     */
    public function takeThing(string $name): Thing
    {
        if (empty($this->things[$name])) {
            throw new ThingNotFound($name);
        }
        return array_pop($this->things[$name]);
    }
    /**
     * Get list of rooms available from the current one
     * @param bool $isArray
     * @return array|string
     */
    public function getAvailableRooms(bool $isArray = false)
    {
        if ($isArray) {
            return $this->availableRooms;
        }
        return implode(', ', array_keys($this->availableRooms));
    }
    /**
     * Get all things from the room or some of them by the name
     * @param  string $name
     * @return mixed
     */
    public function getThings(string $name = '')
    {
        if (!$name) {
            return $this->things;
        }
        if (!isset($this->things[$name])) {
            return null;
        }
        return $this->things[$name];
    }
    /**
     * Get the count of all things or some of them by the name
     * @param string $name
     * @return int|null
     */
    public function getThingsCount(string $name = '')
    {
        if (!$name) {
            return count($this->things);
        }
        if (!isset($this->things[$name])) {
            return null;
        }
        return count($this->things[$name]);
    }
}
