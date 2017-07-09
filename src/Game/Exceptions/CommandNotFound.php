<?php

namespace BinaryStudioAcademy\Game\Exceptions;

class CommandNotFound extends \Exception
{
    public function __construct(string $command, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "Unknown command: '{$command}'.";
    }
}
