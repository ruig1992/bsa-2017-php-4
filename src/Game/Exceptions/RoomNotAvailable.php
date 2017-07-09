<?php

namespace BinaryStudioAcademy\Game\Exceptions;

class RoomNotAvailable extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "Can not go to '{$name}'.";
    }
}
