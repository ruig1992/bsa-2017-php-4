<?php

namespace BinaryStudioAcademy\Game\Worlds;

use BinaryStudioAcademy\Game\Contracts\Player;
use BinaryStudioAcademy\Game\Contracts\GameWorld;

abstract class AbstractWorld implements GameWorld
{
    protected $rooms = [];
    protected $startRoom;

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->makeRooms($options);
    }

    /**
     * Make Rooms for the GameWorld
     * @return $this
     */
    abstract protected function makeRooms(array $options): GameWorld;
    /**
     * Make Things for Rooms of the GameWorld
     * @return $this
     */
    abstract protected function makeThings(): GameWorld;
    /**
     * Make relations of the selected room with those available for it
     * @return $this
     */
    abstract protected function makeAvailableRooms(): GameWorld;
    /**
     * Make the Player with the Room as his starting position in the Game
     * @return Player
     */
    abstract public function makePlayer(): Player;
}
