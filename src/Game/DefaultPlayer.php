<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Player;

class DefaultPlayer implements Player
{
    /**
     * Player name
     * @var string
     */
    protected $name;
    /**
     * Number of coins
     * @var integer
     */
    protected $coins = 0;
    /**
     * Room instance, where the player is located
     * @var Room;
     */
    protected $room;

    /**
     * Set player's name
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Player
    {
        $name = trim($name);
        $this->name = $name ?: self::DEFAULT_NAME;
        return $this;
    }
    /**
     * Set one coin
     * @return $this
     */
    public function setCoin(): Player
    {
        ++$this->coins;
    }
    /**
     * Set player's room
     * @param string $name
     * @return $this
     */
    public function setRoom($room): Player
    {
        $this->room = $room;
        return $this;
    }
    /**
     * Get player's name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Get player's coins
     * @return int
     */
    public function getCoins(): int
    {
        return $this->coins;
    }
    /**
     * Get player's room
     * @return string
     */
    public function getRoom(): string
    {
        return $this->room;
    }
}
