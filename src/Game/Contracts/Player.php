<?php

namespace BinaryStudioAcademy\Game\Contracts;

interface Player
{
    const DEFAULT_NAME = 'Unnamed Gamer';

    public function setName(string $name): self;
    public function getName(): string;
}
