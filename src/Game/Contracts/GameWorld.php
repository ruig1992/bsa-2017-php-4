<?php

namespace BinaryStudioAcademy\Game\Contracts;

interface GameWorld
{
    public function makePlayer(): Player;
}
