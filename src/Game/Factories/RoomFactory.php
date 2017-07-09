<?php

namespace BinaryStudioAcademy\Game\Factories;

class RoomFactory extends Factory
{
    /**
     * The Room instance namespace
     * @var string
     */
    protected static $instanceNS = "\BinaryStudioAcademy\Game\Rooms\\";
    /**
     * The Room instance contract
     * @var string
     */
    protected static $instanceContract = "\BinaryStudioAcademy\Game\Contracts\Room";
    /**
     * The Room instance NotFoundException name
     * @var string
     */
    protected static $instanceExceptionName =
        "\BinaryStudioAcademy\Game\Exceptions\RoomNotFound";
}
