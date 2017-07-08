<?php

namespace BinaryStudioAcademy\Game\Players;

use BinaryStudioAcademy\Game\Contracts\Room;
use BinaryStudioAcademy\Game\Contracts\Player;

class DefaultPlayer implements Player
{
    /**
     * Player name
     * @var string
     */
    protected $name;
    /**
     * Player inventory
     * @var array
     */
    protected $inventory = [];
    /**
     * Room, where the player is located
     * @var Room
     */
    protected $room;

    public function __construct(Room $room)
    {
        $this->room = $room;
        $this->name = self::DEFAULT_NAME;
    }

    /**
     * PHP Magic Get
     * @param  string $property
     * @return mixed
     */
    public function __get(string $property)
    {
        // Get the player name
        if ($property === 'name') {
            return $this->name;
        }
        // Get the current player room
        if ($property === 'room') {
            return $this->room;
        }
        // Get the current count of player coins
        if ($property === 'coins') {
            return count($this->getInventory('coins') ?? []);
        }
        return null;
    }

    /**
     * Set player name
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Player
    {
        if ($name = trim($name)) {
            $this->name = ucfirst($name);
        }
        return $this;
    }
    /**
     * Grab the coin from the current room
     * @return $this
     */
    public function grabCoin(): Player
    {
        $this->inventory['coins'][] = $this->room->addItem('coin');
        return $this;
    }
    /**
     * Go to the next room
     * @param string $roomName
     * @return $this
     */
    public function goToNextRoom(string $roomName): Player
    {
        $this->room = $this->room->getNextRoom($roomName);
        return $this;
    }
    /**
     * Get the player entire inventory or something from it by the type
     * @param  string $type
     * @return mixed
     */
    public function getInventory(string $type = '')
    {
        if (!$type) {
            return $this->inventory;
        }
        if (!isset($this->inventory[$type])) {
            return null;
        }
        return $this->inventory[$type];
    }
}
