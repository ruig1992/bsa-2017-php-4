<?php

namespace BinaryStudioAcademy\Game\Exceptions;

/**
 * CommandNotFound Exception
 *
 * Thrown out when the unknown command in the game is trying to call
 */
class CommandNotFound extends \Exception
{
    public function __construct(string $command, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "Unknown command: '{$command}'.";
    }
}
