<?php

namespace BinaryStudioAcademy\Game\Commands\System;

class SetplayerCommand extends SystemCommand
{
    /**
     * The path to the template file
     * @var string
     */
    protected $fileTemplate = 'setplayer.txt';

    /**
     * Execute the command
     * @param  array|string $params
     * @return string
     */
    public function execute($params = null): string
    {
        var_dump($params);
        $this->msgTemplate = $this->getFromFile();
        $player = $this->game->player->setName($params);

        return $this->buildMessage([
            'player' => $player->name,
        ]);
    }
}
