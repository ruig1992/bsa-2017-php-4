<?php

namespace BinaryStudioAcademy\Game\Exceptions;

class ThingNotFound extends \Exception
{
    public function __construct(string $name, int $code = 0, \Throwable $previous = null)
    {
        $this->message = "There is no {$name}s left here. Type 'where' to go to another location.";
    }
}
