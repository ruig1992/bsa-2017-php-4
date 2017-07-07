<?php

namespace BinaryStudioAcademy\Game\Exceptions;

class RoomNotFound extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        $name = trim($name);
        $this->message = "Room with name '{$name}' does not exist! Try another name...";
    }
}
