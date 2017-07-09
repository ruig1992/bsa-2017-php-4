<?php

namespace BinaryStudioAcademy\Game\Factories;

use BinaryStudioAcademy\Game\Contracts\Thing;
use BinaryStudioAcademy\Game\Exceptions\ThingNotFound;

class ThingFactory extends Factory
{
    /**
     * The Thing instance namespace
     * @var string
     */
    protected static $instanceNS = "\BinaryStudioAcademy\Game\Things\\";
    /**
     * The Thing instance contract
     * @var string
     */
    protected static $instanceContract = "\BinaryStudioAcademy\Game\Contracts\Thing";
    /**
     * The Thing instance NotFoundException name
     * @var string
     */
    protected static $instanceExceptionName =
        "\BinaryStudioAcademy\Game\Exceptions\ThingNotFound";
}
