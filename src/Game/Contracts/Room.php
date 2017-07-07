<?php

namespace BinaryStudioAcademy\Game\Contracts;

interface Room
{
    /**
     * Number of coins available in the room at the game's start
     * @var int
     */
    const COINS_AT_START = 0;

    public function getName(): string;
    public function getAvailableCoins(): int;
}
