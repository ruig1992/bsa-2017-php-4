<?php

namespace BinaryStudioAcademy\Game\Things;

use BinaryStudioAcademy\Game\Contracts\Thing;

abstract class AbstractThing implements Thing
{
    /**
     * Thing name
     * @var string
     */
    protected $name;

    public function __construct()
    {
        $this->name = strtolower(
            str_replace(__NAMESPACE__ . "\\", '', get_called_class())
        );
    }

    /**
     * PHP Magic Get
     * @param  string $property
     * @return mixed
     */
    public function __get(string $property)
    {
        // Get the thing name
        if ($property === 'name') {
            return $this->name;
        }
        return null;
    }
}
