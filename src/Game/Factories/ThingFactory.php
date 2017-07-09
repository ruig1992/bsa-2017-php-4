<?php

namespace BinaryStudioAcademy\Game\Factories;

use BinaryStudioAcademy\Game\Contracts\Thing;
use BinaryStudioAcademy\Game\Exceptions\ThingNotFound;

class ThingFactory
{
    /**
     * Create the new Thing by the name
     * @param string $name
     * @return Thing
     */
    public static function create(string $name): Thing
    {
        $name = ucfirst(trim($name));
        $thing = self::isThingExists($name);
        return $thing;
    }
    /**
     * Checks if there is the thing with the name
     * @param  string  $name
     * @return Thing
     * @throws ThingNotFound Exception
     */
    protected static function isThingExists(string $name): Thing
    {
        $thing = "\BinaryStudioAcademy\Game\Things\\{$name}";
        if (!class_exists($thing) ||
            !(($thing = new $thing) instanceof Thing)
        ) {
            throw new ThingNotFound($name);
        }
        return $thing;
    }
}
