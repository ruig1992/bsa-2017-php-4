<?php

namespace BinaryStudioAcademy\Game\Commands\System;

use BinaryStudioAcademy\Game\Commands\Command;

abstract class SystemCommand extends Command
{
    /**
     * This is a system command
     * @var bool
     */
    const IS_SYSTEM = true;
}
