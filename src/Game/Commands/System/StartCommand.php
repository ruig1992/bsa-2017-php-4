<?php

namespace BinaryStudioAcademy\Game\Commands\System;

class StartCommand extends SystemCommand
{
    /**
     * The path to the template file
     * @var string
     */
    protected $fileTemplate = 'start.txt';

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        $this->msgTemplate = $this->getFromFile();
        return $this->buildMessage();
    }
}
