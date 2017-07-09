<?php

namespace BinaryStudioAcademy\Game\Commands;

class SetplayerCommand extends Command
{
    protected $fileTemplate = APP_TEMPLATES . 'setplayer.txt';

    public function execute($name = null)
    {
        $this->msgTemplate = $this->getFromFile();
        $player = $this->game->player->setName($name);

        return $this->buildMessage([
            'player' => $player->name,
        ]);
    }
}
