<?php

namespace BinaryStudioAcademy\Game\Contracts;

interface Player
{
    const DEFAULT_NAME = 'Unnamed Gamer';

    public function setName(string $name): self;
    public function setCoin(): self;
    public function setRoom(Room $room): self;

    public function getName(): string;
    public function getCoins(): int;
    public function getRoom(): Room;
}
