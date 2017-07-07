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
     * Get player's name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
