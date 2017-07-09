<?php

namespace BinaryStudioAcademy\Game\Commands;

class HelpCommand extends Command
{
    protected $fileTemplate = APP_TEMPLATES . 'help.txt';

    public function execute($params = null)
    {
        return $this->getFromFile();
    }
}
