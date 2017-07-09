<?php

namespace BinaryStudioAcademy\Game\Exceptions;

/**
 * RoomNotAvailable Exception
 *
 * Thrown out when the game's player tries to go to the room
 * that is not available from the current one
 */
class RoomNotAvailable extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "Can not go to {$name}.";
    }
}
