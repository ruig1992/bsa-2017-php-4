<?php

namespace BinaryStudioAcademy\Game\Rooms;

use BinaryStudioAcademy\Game\Contracts\Room;

class AbstractRoom implements Room
{
    /**
     * Room's name
     * @var string
     */
    protected $name;
    /**
     * Number of coins available in the room
     * @var int
     */
    protected $availableCoins;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->availableCoins = static::COINS_AT_START;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get room's name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Get number of coins available in the room
     * @return int
     */
    public function getAvailableCoins(): int
    {
        return $this->availableCoins;
    }
}
