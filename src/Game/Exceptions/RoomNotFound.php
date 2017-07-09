<?php

namespace BinaryStudioAcademy\Game\Exceptions;

/**
 * RoomNotFound Exception
 *
 * Thrown out when there is an attempt to act with a non-existent Room
 * (for example, when creating)
 */
class RoomNotFound extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "Room '{$name}' does not found.";
    }
}
