<?php

namespace BinaryStudioAcademy\Game\Exceptions;

class RoomNotFound extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "Room '{$name}' does not found.";
    }
}
