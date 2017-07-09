<?php

namespace BinaryStudioAcademy\Game\Factories;

abstract class Factory
{
    /**
     * The Instance namespace
     * @var string
     */
    protected static $instanceNS = '';
    /**
     * The Instance contract
     * @var string
     */
    protected static $instanceContract = '';
    /**
     * The Instance NotFoundException name
     * @var string
     */
    protected static $instanceExceptionName = '';

    /**
     * Create the new Instance by its name
     * @param string $name
     * @return the Instance type
     */
    public static function create(string $name)
    {
        $name = ucfirst(trim($name));
        $instance = static::isInstanceTypeExists($name);
        return $instance;
    }
    /**
     * Checks does the Instance exist by its name
     * @param  string  $name
     * @return the Instance type
     * @throws the Instance NotFound Exception
     */
    protected static function isInstanceTypeExists(string $name)
    {
        $instance = static::$instanceNS . $name;

        if (!class_exists($instance) ||
            !(($instance = new $instance) instanceof static::$instanceContract)
        ) {
            throw new static::$instanceExceptionName($name);
        }

        return $instance;
    }
}
