<?php

namespace BinaryStudioAcademy\Game\Commands;

class ExitCommand extends Command
{
    protected $fileTemplate = APP_TEMPLATES . 'exit.txt';

    public function execute($params = null)
    {
        CommandManager::isFinished(true);
        return $this->getFromFile();
    }
}
