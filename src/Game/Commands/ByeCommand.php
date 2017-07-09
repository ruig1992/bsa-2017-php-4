<?php

namespace BinaryStudioAcademy\Game\Commands;

class ByeCommand extends Command
{
    protected $fileTemplate = APP_TEMPLATES . 'bye.txt';

    public function execute($params = null)
    {
        $this->msgTemplate = $this->getFromFile();

        return $this->buildMessage([
            'player' => $this->game->player->name,
        ]);
    }
}
