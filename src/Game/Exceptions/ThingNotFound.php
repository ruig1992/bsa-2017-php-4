<?php

namespace BinaryStudioAcademy\Game\Exceptions;

/**
 * ThingNotFound Exception
 *
 * Thrown out when there is an attempt to act with a non-existent Thing
 * (for example, when creating)
 */
class ThingNotFound extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "There is no {$name}s left here. Type 'where' to go to another location.";
    }
}
