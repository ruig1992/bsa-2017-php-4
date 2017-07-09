<?php

namespace BinaryStudioAcademy\Game\Commands;

class StartCommand extends Command
{
    protected $fileTemplate = APP_TEMPLATES . 'start.txt';

    public function execute($params = null)
    {
        $this->msgTemplate = $this->getFromFile();
        return $this->buildMessage();
    }
}
