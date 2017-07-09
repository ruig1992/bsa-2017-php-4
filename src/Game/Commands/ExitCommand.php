<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\GameManager;

class ExitCommand extends Command
{
    /**
     * The path to the template file
     * @var string
     */
    protected $fileTemplate = 'exit.txt';

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        GameManager::isFinished(true);
        return $this->getFromFile();
    }
}
