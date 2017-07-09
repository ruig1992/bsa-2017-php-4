<?php

namespace BinaryStudioAcademy\Game\Commands;

class HelpCommand extends Command
{
    /**
     * The path to the template file
     * @var string
     */
    protected $fileTemplate = 'help.txt';

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        return $this->getFromFile();
    }
}
